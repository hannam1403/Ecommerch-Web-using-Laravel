<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AdminBannerManagerRequest;
use App\Models\Banner;
use Exception;

class BannerManagerController extends Controller
{
    public function index(){
        $banners = new Banner();
        $banners = $banners->getBannerData()->paginate(2);
        return view('Admin.bannerManager',['banners' =>  $banners]);
    }

    public function search(Request $request){
        $banners = new Banner();
        $banners = $banners->getBannerSearchData($request)->paginate(2);
        return view('Admin.bannerManager',['banners' =>  $banners]);
    }

    /**
     * Summary of addBanner
     * @param \App\Http\Requests\AdminBannerManagerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addBanner(AdminBannerManagerRequest $request) {
        try{
            $banners = new Banner();
            $banners->addBanner($request);
            $message = 'Thêm mới banner thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex) {
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect('/BannerManager');
    }

    public function deleteBanner($id) {
        try{
            $banners = new Banner();
            $banners->deleteBanner($id);
            $message = 'Xóa banner thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex) {
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        
        return redirect()->back(); 
    }
}
