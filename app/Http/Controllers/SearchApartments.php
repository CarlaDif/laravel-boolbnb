<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;
use DB;
use Illuminate\Http\Request;

class SearchApartments extends Controller
{

  public function inputSearch(Request $request)
  {
       if($request->ajax()){
         $apartments = DB::table('apartments')
         ->where('title','LIKE', '%'.$request->apartment_name.'%')
         ->get();
         return response()->json([
           'search'=>$apartments,
       ]);
     }
   }

 public function page(Request $request){

    $validatedData = $request->validate([
      'search' => 'required',
    ]);

    $lat = $request->h_latitude;
    $lon = $request->h_longitude;
    $radius = 20;
    $R = 6371;
    //$place_radius = 5;
    $apartments = DB::table('apartments')
        ->selectRaw('id, title, address, latitude, longitude, main_img, acos(sin(".$lat.")*sin(radians(latitude)) + cos(".$lat.")*cos(radians(latitude))*cos(radians(longitude)-".$lon.")) * ".$R." As distance')
        ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")
        ->orderByRaw('distance')
        ->get();

    // $apartments = Apartment::all();
    // $search = $request->search;

    return view('search_page')->with([
       'apartments'=>$apartments,
       // 'search'=>$search
    ]);

 }

}
