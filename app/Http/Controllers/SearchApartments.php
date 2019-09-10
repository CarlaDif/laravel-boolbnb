<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;
use Illuminate\Support\Facades\DB;
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

      // $validatedData = $request->validate([
      //   'search' => 'required',
      // ]);

      $lat = $request->latitude;
      $lon = $request->longitude;
      $radius = 20;
      $R = 6371;

      //$place_radius = 5;
      $apartments = DB::table('apartments')
          ->selectRaw('id, title, address, latitude, longitude, main_img, acos(sin(".$lat.")*sin(radians(latitude)) + cos(".$lat.")*cos(radians(latitude))*cos(radians(longitude)-".$lon.")) * ".$R." As distance')
          ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")
          ->orderByRaw('distance')
          ->get();


      return view('search_page')->with([
         'apartments'=>$apartments,
         // 'search'=>$search
      ]);

   }

  public function filters(Request $request){

    $apartments = new Apartment;
    $apartments = DB::table('apartments')
    ->where('n_baths',$request->n_baths )
    ->where('n_single_beds',$request->n_single_beds )
    ->where('n_double_beds',$request->n_double_beds );
    if ($request->price >0) {
      $apartments = $apartments->where('price',$request->price );
    }
    $apartments = $apartments->get();
    return view('search_page')->with([
       'apartments'=>$apartments,
       // 'search'=>$search
    ]);
  }
}
