<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;
use App\Service;
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

  public function page(Request $request) {

      // $validatedData = $request->validate([
      //   'search' => 'required',
      // ]);
      $services = Service::all();
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
         'latitude' => $lat,
         'longitude' => $lon,
         'services'=> $services

      ]);
   }

  public function filters(Request $request){

    $apartments = new Apartment;
    $services = Service::all();

    if ($request->n_baths > 0 || $request->n_single_beds > 0 || $request->n_double_beds > 0) {
      $apartments = DB::table('apartments')
                ->where('n_baths',$request->n_baths )
                ->where('n_single_beds',$request->n_single_beds )
                ->where('n_double_beds',$request->n_double_beds );
    }

    if ($request->price > 0) {
      $apartments = $apartments->where('price','<=',$request->price );
    }


// -------------------------SERVIZI-------------------------
// ---------------------------------------------------------
    if (!empty($request->services) ) {
          $apartments = $apartments->whereHas('services', function($q) use ($request) {
                          $q->where('services.name',$request->services);
                      });
    }//IF
    // -------------------------END SERVIZI----------------------
    // ---------------------------------------------------------


    if ($request->latitude && $request->longitude) {
      $radius = $request->inputRadius;
      $lat = $request->latitude;
      $lon = $request->longitude;
      $R = 6371;

      $apartments = $apartments
              ->selectRaw('id, title, address, latitude, longitude, main_img, acos(sin(".$lat.")*sin(radians(latitude)) + cos(".$lat.")*cos(radians(latitude))*cos(radians(longitude)-".$lon.")) * ".$R." As distance')
              ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R < $radius")
              ->orderByRaw('distance');
    }

    $apartments = $apartments->get();

    return view('search_page')->with([
       'apartments'=>$apartments,
       'latitude' => $lat,
       'longitude' => $lon,
       'services'=> $services
       // 'search'=>$search
    ]);
  }
  //
  // public function filterApartments(Request $request) {
  //   $radius = $request->inputRadius;
  //   $lat = $request->latitude;
  //   $lon = $request->longitude;
  //   $R = 6371;
  //
  //   $apartments = DB::table('apartments')
  //       ->selectRaw('id, title, address, latitude, longitude, main_img, acos(sin(".$lat.")*sin(radians(latitude)) + cos(".$lat.")*cos(radians(latitude))*cos(radians(longitude)-".$lon.")) * ".$R." As distance')
  //       ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")
  //       ->orderByRaw('distance')
  //       ->get();
  //
  //   return view('search_page')->with([
  //      'apartments'=>$apartments,
  //      'latitude' => $lat,
  //      'longitude' => $lon
  //   ]);
  // }

 }
