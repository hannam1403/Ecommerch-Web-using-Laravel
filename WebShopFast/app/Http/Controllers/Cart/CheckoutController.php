<?php

namespace App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index() 
    {
        $checkout = new Checkout();
        $checkout = $checkout->getDataForCheckout();
        return view('ProductCheckout.Checkout.DetailCheckout')->with('carts', $checkout->getCarts())
        ->with('totalPrices', $checkout->getTotalPrices())
        ->with('totalProduct', $checkout->getTotalProduct());
    }

    public function AddNewAddress(Request $request) 
    {
        $checkout = new Checkout();
        $checkout = $checkout->AddNewAddress($request);
        return response()->json(['UserName' => $checkout->getUserName(), 'Phone' => $checkout->getPhone(),'newAddress' => $checkout->getNewAddress()]);
    }

    public function UpdatePaymentMethod(Request $request) 
    {
        $checkout = new Checkout();
        $checkout = $checkout->UpdatePaymentMethod($request);
        return response()->json(['PaymentMethodName' => $checkout->getPaymentMethodName()]);
    }

    public function ChangeAddressCart(Request $request) 
    {
        $checkout = new Checkout();
        $checkout = $checkout->ChangeAddressCart($request);
        return response()->json(['AddressName' => $checkout->getAddressName()]);
    }

    public function UpdateAddress(Request $request) 
    {
        $checkout = new Checkout();
        $checkout = $checkout->UpdateAddress($request);
        return response()->json(['userId' => $checkout->getUserId(), 'addressId' => $checkout->getAddressId(), 'newAddress' => $checkout->getNewAddress()]);
    }

    public function checkout(Request $request)
    {
        $userId = $request->session()->get('my_user_id');

        // Retrieve the user's cart
        $cart = DB::table('cart')->where('member_id', $userId)->where('Status', '=', 0)->first();

        $paymentMethod = DB::select('select PaymentMethodId from cart where member_id = :userId and Status = 0',
        [
            "userId" => $userId
        ]);

        $member = DB::table('member')->where('Id', $userId)->first();

        $accountBalance = $member->AccountBalance;

        $cartDetails = DB::table('cartdetail')
                    ->where('CartId', $cart->Id)
                    ->get();

        $totalPrice = DB::table('cartdetail')
        ->where('CartId', $cart->Id)
        ->sum(DB::raw('Price * Quantity'));           

        $activeAddress = DB::table('address as a')
                     ->join('cart as c' , 'c.AddressId' , '=' , 'a.ID')
                     ->where('a.MemberId', $userId)
                     ->where('c.Status', '=', 0)
                     ->first();

        // Check if the quantity of each product in cart is less than or equal to the quantity of the same product in the shop
        foreach ($cartDetails as $detail) {
            $productId = $detail->ProductId;
            $quantityInCart = $detail->Quantity;
            $product = DB::table('product')->where('Id', $productId)->first();
            if ($product->QuantityInStock < $quantityInCart) {
                // The quantity of the product in cart is greater than the quantity of the same product in the shop, so return an error message
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'The quantity of ' . $product->Name . ' in cart is greater than the quantity in stock.']);
                } else {
                    $error = 'The quantity of ' . $product->Name . ' in cart is greater than the quantity in stock.'; // Set the error message
                    return redirect()->back()->withErrors([$error]);
                }
            }
        }   

        if ($request->isMethod('post') && $request->input('buy')) {    
            if($paymentMethod[0]->PaymentMethodId == 2){
                // Create a new bill record
                $bill = DB::table('bill')->insertGetId([
                    'IdMember' => $userId,
                    'TotalPrice' => $totalPrice,
                    'Address' => $activeAddress->Name,
                    'create_at' => now(),
                    'PaymentMethod' => 2,
                ]);

                // Insert the cart details into the bill_details table
                $cartDetails = DB::table('cartdetail')
                            ->where('CartId', $cart->Id)
                            ->get();
                foreach ($cartDetails as $detail) {
                    $product = DB::table('product')->where('Id', $detail->ProductId)->first();
                    DB::table('billdetail')->insert([
                        'IdBill' => $bill,
                        'IdProduct' => $product->Id,
                        'ProductName' => $product->Name,
                        'Quantity' => $detail->Quantity,
                        'Price' => $detail->Price,
                    ]);

                    // Decrease the quantity of the product in the shop by the quantity in the cart
                    DB::table('product')->where('Id', $detail->ProductId)->decrement('QuantityInStock', $detail->Quantity);
                }

                //Update status of the cart to 1 ( Not active )
                DB::table('cart')->where('member_id', $userId)->update(['Status' => 1]);

                if ($request->ajax()) {
                    return response()->json(['success' => true]);
                } else {
                    return redirect()->route('/MainWeb')->with('success', 'Your order has been placed.');
                }               
            }
            elseif($paymentMethod[0]->PaymentMethodId == 1){
                if ($accountBalance < $totalPrice) {
                    // The account balance is less than the total price, so return an error message
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' =>'Insufficient funds.']);
                    // } else {
                    //     $error = 'Insufficient funds.'; // Set the error message
                    //     return redirect()->back()->withErrors([$error]);
                    }
                }
                else{
                    $member = DB::table('member')->where('Id', $userId)->first();

                    $accountBalance = $member->AccountBalance;
    
                    $totalPrice = DB::table('cartdetail')
                        ->where('CartId', $cart->Id)
                        ->sum(DB::raw('Price * Quantity'));  
    
                    // Create a new bill record
                    $bill = DB::table('bill')->insertGetId([
                        'IdMember' => $userId,
                        'TotalPrice' => $totalPrice,
                        'Address' => $activeAddress->Name,
                        'create_at' => now(),
                        'PaymentMethod' => 1,
                    ]);
    
                    // Insert the cart details into the bill_details table
                    $cartDetails = DB::table('cartdetail')
                                ->where('CartId', $cart->Id)
                                ->get();
                    foreach ($cartDetails as $detail) {
                        $product = DB::table('product')->where('Id', $detail->ProductId)->first();
                        DB::table('billdetail')->insert([
                            'IdBill' => $bill,
                            'IdProduct' => $product->Id,
                            'ProductName' => $product->Name,
                            'Quantity' => $detail->Quantity,
                            'Price' => $detail->Price,
                        ]);
    
                        // Decrease the quantity of the product in the shop by the quantity in the cart
                        DB::table('product')->where('Id', $detail->ProductId)->decrement('QuantityInStock', $detail->Quantity);
                    }
    
                    $newBalance = $accountBalance - $totalPrice;

                    DB::table('member')->where('Id', $userId)->update(['AccountBalance' => $newBalance]);
    
                    DB::table('cart')->where('member_id', $userId)->update(['Status'=> 1]);
    
                    if ($request->ajax()) {
                        return response()->json(['success' => true]);
                    } else {
                        return redirect()->route('/MainWeb')->with('success', 'Your order has been placed.'); 
                    }
                }
            }
        }      
        return view('ProductCheckout/Checkout/DetailCheckout', compact('cartDetails', 'totalPrice'));
    }
}
