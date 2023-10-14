<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashBoard extends Model
{
    use HasFactory;
    private $GetDataChartDayRevenue;
    private $GetDataChartMonthRevenue;
    private $GetDataChartStatusBill;
    private $GetDataChartDayProduct;
    private $GetDataChartTopProduct;
    private $GetDataChartDayRevenueAdmin;
    private $GetDataChartMonthRevenueAdmin;
    private $GetDataChartStatusBillAdmin;
    private $GetDataChartDayProductAdmin;
    private $GetDataChartTopProductAdmin;
    private $GetDataChartMonthProductUploadAdmin;

    /**
     * Get the value of GetDataChartDayRevenue
     */ 
    public function getGetDataChartDayRevenue()
    {
        return $this->GetDataChartDayRevenue;
    }

    /**
     * Set the value of GetDataChartDayRevenue
     *
     * @return  self
     */ 
    public function setGetDataChartDayRevenue($GetDataChartDayRevenue)
    {
        $this->GetDataChartDayRevenue = $GetDataChartDayRevenue;

        return $this;
    }

    /**
     * Get the value of GetDataChartMonthRevenue
     */ 
    public function getGetDataChartMonthRevenue()
    {
        return $this->GetDataChartMonthRevenue;
    }

    /**
     * Set the value of GetDataChartMonthRevenue
     *
     * @return  self
     */ 
    public function setGetDataChartMonthRevenue($GetDataChartMonthRevenue)
    {
        $this->GetDataChartMonthRevenue = $GetDataChartMonthRevenue;

        return $this;
    }

    /**
     * Get the value of GetDataChartStatusBill
     */ 
    public function getGetDataChartStatusBill()
    {
        return $this->GetDataChartStatusBill;
    }

    /**
     * Set the value of GetDataChartStatusBill
     *
     * @return  self
     */ 
    public function setGetDataChartStatusBill($GetDataChartStatusBill)
    {
        $this->GetDataChartStatusBill = $GetDataChartStatusBill;

        return $this;
    }

    /**
     * Get the value of GetDataChartDayProduct
     */ 
    public function getGetDataChartDayProduct()
    {
        return $this->GetDataChartDayProduct;
    }

    /**
     * Set the value of GetDataChartDayProduct
     *
     * @return  self
     */ 
    public function setGetDataChartDayProduct($GetDataChartDayProduct)
    {
        $this->GetDataChartDayProduct = $GetDataChartDayProduct;

        return $this;
    }

    /**
     * Get the value of GetDataChartTopProduct
     */ 
    public function getGetDataChartTopProduct()
    {
        return $this->GetDataChartTopProduct;
    }

    /**
     * Set the value of GetDataChartTopProduct
     *
     * @return  self
     */ 
    public function setGetDataChartTopProduct($GetDataChartTopProduct)
    {
        $this->GetDataChartTopProduct = $GetDataChartTopProduct;

        return $this;
    }

    
    /**
     * Get the value of GetDataChartDayRevenueAdmin
     */ 
    public function getGetDataChartDayRevenueAdmin()
    {
        return $this->GetDataChartDayRevenueAdmin;
    }

    /**
     * Set the value of GetDataChartDayRevenueAdmin
     *
     * @return  self
     */ 
    public function setGetDataChartDayRevenueAdmin($GetDataChartDayRevenueAdmin)
    {
        $this->GetDataChartDayRevenueAdmin = $GetDataChartDayRevenueAdmin;

        return $this;
    }

    /**
     * Get the value of GetDataChartMonthRevenueAdmin
     */ 
    public function getGetDataChartMonthRevenueAdmin()
    {
        return $this->GetDataChartMonthRevenueAdmin;
    }

    /**
     * Set the value of GetDataChartMonthRevenueAdmin
     *
     * @return  self
     */ 
    public function setGetDataChartMonthRevenueAdmin($GetDataChartMonthRevenueAdmin)
    {
        $this->GetDataChartMonthRevenueAdmin = $GetDataChartMonthRevenueAdmin;

        return $this;
    }

    /**
     * Get the value of GetDataChartStatusBillAdmin
     */ 
    public function getGetDataChartStatusBillAdmin()
    {
        return $this->GetDataChartStatusBillAdmin;
    }

    /**
     * Set the value of GetDataChartStatusBillAdmin
     *
     * @return  self
     */ 
    public function setGetDataChartStatusBillAdmin($GetDataChartStatusBillAdmin)
    {
        $this->GetDataChartStatusBillAdmin = $GetDataChartStatusBillAdmin;

        return $this;
    }

    /**
     * Get the value of GetDataChartDayProductAdmin
     */ 
    public function getGetDataChartDayProductAdmin()
    {
        return $this->GetDataChartDayProductAdmin;
    }

    /**
     * Set the value of GetDataChartDayProductAdmin
     *
     * @return  self
     */ 
    public function setGetDataChartDayProductAdmin($GetDataChartDayProductAdmin)
    {
        $this->GetDataChartDayProductAdmin = $GetDataChartDayProductAdmin;

        return $this;
    }

    /**
     * Get the value of GetDataChartMonthProductUploadAdmin
     */ 
    public function getGetDataChartMonthProductUploadAdmin()
    {
        return $this->GetDataChartMonthProductUploadAdmin;
    }

    /**
     * Set the value of GetDataChartMonthProductUploadAdmin
     *
     * @return  self
     */ 
    public function setGetDataChartMonthProductUploadAdmin($GetDataChartMonthProductUploadAdmin)
    {
        $this->GetDataChartMonthProductUploadAdmin = $GetDataChartMonthProductUploadAdmin;

        return $this;
    }

    public function GetDataChartDayRevenue(Request $request) 
    {
        $ShopId =  $request->Input('ShopId');
        $FromDate =  $request->Input('FromDate');
        $ToDate =  $request->Input('ToDate');

        $GetDataChartDayRevenue = DB::select('CALL GetDataChartDayRevenue(:userId, :FromDate, :ToDate)', 
        [
             "userId" => $ShopId,
             "FromDate" => $FromDate,
             "ToDate" => $ToDate,
        ]);

        $this->setGetDataChartDayRevenue($GetDataChartDayRevenue);

        return  $this;
    }
    public function GetDataChartMonthRevenue(Request $request) 
    {
        $ShopId =  $request->Input('ShopId');
        $Year =  $request->Input('Year');
        $FromMonth =  $request->Input('FromMonth');
        $ToMonth =  $request->Input('ToMonth');

        $GetDataChartMonthRevenue = DB::select('CALL GetDataChartMonthRevenue(:userId, :Year, :FromMonth, :ToMonth)', 
        [
             "userId" => $ShopId,
             "Year" => $Year,
             "FromMonth" => $FromMonth,
             "ToMonth" => $ToMonth
        ]);

        $this->setGetDataChartMonthRevenue($GetDataChartMonthRevenue);

        return  $this;
    }

    public function GetDataChartStatusBill(Request $request) 
    {
        $ShopId =  $request->Input('ShopId');

        $GetDataChartStatusBill = DB::select('CALL GetDataChartStatusBill(:userId)', 
        [
             "userId" => $ShopId
        ]);

        $this->setGetDataChartStatusBill($GetDataChartStatusBill);

        return  $this;
    }
    public function GetDataChartDayProduct(Request $request) 
    {
        $ShopId =  $request->Input('ShopId');
        $FromDate =  $request->Input('FromDate');
        $ToDate =  $request->Input('ToDate');

        $GetDataChartDayProduct = DB::select('CALL GetDataChartDayProduct(:userId, :FromDate, :ToDate)', 
        [
             "userId" => $ShopId,
             "FromDate" => $FromDate,
             "ToDate" => $ToDate,
        ]);

        $this->setGetDataChartDayProduct($GetDataChartDayProduct);

        return  $this;

    }

    public function GetDataChartTopProduct(Request $request) 
    {
        $ShopId =  $request->Input('ShopId');

        $GetDataChartTopProduct = DB::select('CALL GetDataChartTopProduct(:userId)', 
        [
             "userId" => $ShopId
        ]);

        $this->setGetDataChartTopProduct($GetDataChartTopProduct);

        return  $this;
    }

    public function GetDataChartDayRevenueAdmin(Request $request) 
    {
        $FromDate =  $request->Input('FromDate');
        $ToDate =  $request->Input('ToDate');

        $GetDataChartDayRevenueAdmin = DB::select('CALL GetDataChartDayRevenueAdmin(:FromDate, :ToDate)', 
        [
             "FromDate" => $FromDate,
             "ToDate" => $ToDate,
        ]);

        $this->setGetDataChartDayRevenueAdmin($GetDataChartDayRevenueAdmin);
        return $this;
    }

    public function GetDataChartMonthRevenueAdmin(Request $request) 
    {
        $Year =  $request->Input('Year');
        $FromMonth =  $request->Input('FromMonth');
        $ToMonth =  $request->Input('ToMonth');

        $GetDataChartMonthRevenueAdmin = DB::select('CALL GetDataChartMonthRevenueAdmin(:Year, :FromMonth, :ToMonth)', 
        [
             "Year" => $Year,
             "FromMonth" => $FromMonth,
             "ToMonth" => $ToMonth
        ]);

        $this->setGetDataChartMonthRevenueAdmin($GetDataChartMonthRevenueAdmin);
        return $this;
    }

    public function GetDataChartStatusBillAdmin() 
    {

        $GetDataChartStatusBillAdmin = DB::select('CALL GetDataChartStatusBillAdmin()');

        $this->setGetDataChartStatusBillAdmin($GetDataChartStatusBillAdmin);
        return $this;
    }

    public function GetDataChartDayProductAdmin(Request $request) 
    {
        $FromDate =  $request->Input('FromDate');
        $ToDate =  $request->Input('ToDate');

        $GetDataChartDayProductAdmin = DB::select('CALL GetDataChartDayProductAdmin( :FromDate, :ToDate)', 
        [
             "FromDate" => $FromDate,
             "ToDate" => $ToDate,
        ]);

        $this->setGetDataChartDayProductAdmin($GetDataChartDayProductAdmin);
        return $this;
    }

    public function GetDataChartTopProductAdmin() 
    {
        $GetDataChartTopProductAdmin = DB::select('CALL GetDataChartTopProductAdmin()');
        return $GetDataChartTopProductAdmin;
    }

    public function GetDataChartMonthProductUploadAdmin(Request $request) 
    {
        $Year =  $request->Input('Year');
        $FromMonth =  $request->Input('FromMonth');
        $ToMonth =  $request->Input('ToMonth');

        $GetDataChartMonthProductUploadAdmin = DB::select('CALL GetDataChartMonthProductUploadAdmin(:Year, :FromMonth, :ToMonth)', 
        [
             "Year" => $Year,
             "FromMonth" => $FromMonth,
             "ToMonth" => $ToMonth
        ]);
        $this->setGetDataChartMonthProductUploadAdmin($GetDataChartMonthProductUploadAdmin);
        return $this;
    }

}
