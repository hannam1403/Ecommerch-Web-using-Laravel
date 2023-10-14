<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Member;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\DashBoard;


class DashBoardController extends Controller
{
    public function GetDataChartDayRevenue(Request $request) 
    {
        $dashboard = new DashBoard();
        $dashboard = $dashboard->GetDataChartDayRevenue($request);

        return response()->json(['GetDataChartDayRevenue' => $dashboard->getGetDataChartDayRevenue() ]);
    }

    public function GetDataChartMonthRevenue(Request $request) 
    {
        $dashboard = new DashBoard();
        $dashboard = $dashboard->GetDataChartMonthRevenue($request);

        return response()->json(['GetDataChartMonthRevenue' => $dashboard->getGetDataChartMonthRevenue()]);
    }

    public function GetDataChartStatusBill(Request $request) 
    {
        $dashboard = new DashBoard();
        $dashboard = $dashboard->GetDataChartStatusBill($request);

        return response()->json(['GetDataChartStatusBill' => $dashboard->getGetDataChartStatusBill()]);
    }

    public function GetDataChartDayProduct(Request $request) 
    {
        $dashboard = new DashBoard();
        $dashboard = $dashboard->GetDataChartDayProduct($request);

        return response()->json(['GetDataChartDayProduct' => $dashboard->getGetDataChartDayProduct() ]);
    }

    public function GetDataChartTopProduct(Request $request) 
    {
        $dashboard = new DashBoard();
        $dashboard = $dashboard->GetDataChartTopProduct($request);

        return response()->json(['GetDataChartTopProduct' => $dashboard->getGetDataChartTopProduct()]);
    }
}
