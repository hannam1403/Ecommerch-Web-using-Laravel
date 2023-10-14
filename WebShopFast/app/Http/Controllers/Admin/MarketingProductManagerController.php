<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketingProductManagerController extends Controller
{
    public function index(){
        $marketingproductsmanager = DB::table('marketingproduct')
                ->select('marketingproduct.Id as Id', 'marketingproduct.ProductId as ProductId', 'marketing.Name as MarketingName', 'marketingproduct.Create_At as Time')
                ->join('marketing', 'marketingproduct.MarketingId', '=', 'marketing.Id')
                ->where('marketingproduct.Status', '=', 1)
                ->paginate(10);

        return view('Admin.MarketingProductManager', compact('marketingproductsmanager'));
    }

    public function search(Request $request){
        $var_search = $request->query('var_search');
        $marketingproductsmanager = DB::table('marketingproduct')
                ->select('marketingproduct.Id as Id', 'marketingproduct.ProductId as ProductId', 'marketing.Name as MarketingName', 'marketingproduct.Create_At as Time')
                ->join('marketing', 'marketingproduct.MarketingId', '=', 'marketing.Id')
                ->where('ProductId', 'like', '%' . $var_search . '%')
                ->where('marketingproduct.Status', '=', 1)
                ->paginate(10);

        return view('Admin.MarketingProductManager', compact('marketingproductsmanager'));
    }

    public function deleteProductMarketing(Request $request){
        // Get the current date minus 30 days
        $dateThreshold = Carbon::now()->subDays(30)->toDateTimeString();

        // Update the status of marketing products that meet the criteria
        DB::table('marketingproduct')
            ->where('Create_At', '<', $dateThreshold)
            ->where('Status', 1)
            ->update(['Status' => 0]);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
