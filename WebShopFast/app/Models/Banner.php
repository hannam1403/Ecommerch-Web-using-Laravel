<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;
    private $Id;
    private $BannerPath;
    private $BannerName;

    public function getBannerData(){
        $banners = DB::table('banner')
        ->select('banner.Id as BannerId', 'banner.BannerName as Name', 'banner.BannerPath as Picture');
        return $banners;
    }

    public function getBannerSearchData(Request $request){
        $var_search = $request->query('var_search');
        $banners = DB::table('banner')
        ->select('banner.Id as BannerId', 'banner.BannerName as Name', 'banner.BannerPath as Picture')
        ->where('banner.BannerName', 'like', '%' . $var_search . '%');
        return $banners;
    }


    public function addBanner(Request $request) {
        $bannername = $request->input('BannerName');
        $bannerImage = 'Banner'.'-'.time().'.'.$request->ImageBanner->extension();
        $request->ImageBanner->move(public_path('images/Banner/'), $bannerImage);

        DB::table('banner')->insert([
            'BannerPath' => $bannerImage,
            'BannerName' => $bannername
        ]);
    }

    public function deleteBanner($id) {
        DB::delete("DELETE FROM banner where Id = :BannerId", 
        [
                'BannerId' => $id,
        ]);
    }
}
