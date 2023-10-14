<?php

namespace App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        $cart = new Cart();
        $cart = $cart->getDataForCart();
        return view('ProductCheckout.Cart.DetailCart')->with('carts', $cart->getCarts())
        ->with('totalPrices', $cart->getTotalPrices())
        ->with('totalProduct', $cart->getTotalProduct());
    }

    public function increaseQuantity($CartDetailID)
    {
        $cart = new Cart();
        $cart = $cart->increaseQuantity($CartDetailID);
        return response()->json(['quantity' => $cart->getNewQuantity(), 'PriceProductAmount' => $cart->getPriceProductAmount(), 'totalPrices' => $cart->getTotalPrices()]);
    }

    public function decreaseQuantity($CartDetailID)
    {
        $cart = new Cart();
        $cart = $cart->decreaseQuantity($CartDetailID);
        return response()->json(['quantity' => $cart->getNewQuantity(), 'PriceProductAmount' => $cart->getPriceProductAmount(), 'totalPrices' => $cart->getTotalPrices()]);
    }

    public function removeProductFromCart($CartDetailID) {
        $cart = new Cart();
        $cart = $cart->removeProductFromCart($CartDetailID);
        return redirect(('/DetailCart')); 
    }

    public function addProductToCart($ProductId) {
        $cart = new Cart();
        $cart = $cart->addProductToCart($ProductId);
        return response()->json(['isExist' => $cart->getIsExist()]);;
    }

    public function removeCartProduct($id) {
        $cart = new Cart();
        $cart = $cart->removeCartProduct($id);
        return redirect('/DetailCart'); 
    }
}
