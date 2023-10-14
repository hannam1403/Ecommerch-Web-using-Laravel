<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DashBoard;



class AdminDashBoardController extends Controller
{
    public function GetDataChartDayRevenueAdmin(Request $request) 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartDayRevenueAdmin($request);


        return response()->json(['GetDataChartDayRevenueAdmin' => $addashboard->getGetDataChartDayRevenueAdmin() ]);
    }

    public function GetDataChartMonthRevenueAdmin(Request $request) 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartMonthRevenueAdmin($request);

        return response()->json(['GetDataChartMonthRevenueAdmin' => $addashboard->getGetDataChartMonthRevenueAdmin()]);
    }

    public function GetDataChartStatusBillAdmin() 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartStatusBillAdmin();

        return response()->json(['GetDataChartStatusBillAdmin' => $addashboard->getGetDataChartStatusBillAdmin()]);
    }

    public function GetDataChartDayProductAdmin(Request $request) 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartDayProductAdmin($request);

        return response()->json(['GetDataChartDayProductAdmin' => $addashboard->getGetDataChartDayProductAdmin() ]);
    }

    public function GetDataChartTopProductAdmin() 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartTopProductAdmin();
        return response()->json(['GetDataChartTopProductAdmin' => $addashboard]);
    }

    public function GetDataChartMonthProductUploadAdmin(Request $request) 
    {
        $addashboard = new DashBoard();
        $addashboard = $addashboard->GetDataChartMonthProductUploadAdmin($request);

        return response()->json(['GetDataChartMonthProductUploadAdmin' => $addashboard->getGetDataChartMonthProductUploadAdmin()]);
    }
}
