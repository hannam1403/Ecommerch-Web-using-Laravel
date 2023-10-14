<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MarketingProduct;
use Carbon\Carbon;

class MarketingProductController extends Controller
{
    public function index(Request $request)
    {        
        $marketing = new MarketingProduct();
        $search = $request->input('search');
        $marketingId = $request->input('marketing_id');
        $marketing = $marketing->getDataForMarketingProduct($search, $marketingId);     
        $selectedMarketingId = $marketingId ?? null;
        // return view('Shop.MarketingProduct')->with('DataMarketingProduct', $marketing->getDataMarketingProduct()->paginate(10));
        return view('Shop.MarketingProduct', compact('marketing', 'search', 'selectedMarketingId'));
    }

    public function AddProductWithMarketing(Request $request)
    {        
        $marketing = new MarketingProduct();
        $marketing = $marketing->AddProductWithMarketing($request);

        return response()->json(['IsSucces' => $marketing->getIsSucces()]);
    }

    public function DeleteProductWithMarketing($id){
        $marketing = new MarketingProduct();
        $marketing->DeleteProductWithMarketing($id);
        return redirect()->back();
    }
}
