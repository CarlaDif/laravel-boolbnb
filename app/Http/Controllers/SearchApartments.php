<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
      //query per aggiornare lo status sponsorizzazione degli appartamenti
      $now_query = Carbon::now();
      $sponsorships = DB::table('sponsorships')
                      ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                      ->where('is_sponsored', 1)
                      ->where('sponsor_end_at', '>', $now_query) //recupero le date di scadenza delle sponsorizzazioni che ancora devono scadere
                      ->get();
      // dd($sponsorships);

      //funzione di reset nel caso in cui la sponsorizzazione sia scaduta
      if ($sponsorships) {
        foreach ($sponsorships as $sponsorship) {
          //controllo tra la data attuale e quella della scadenza dell'ultima sponsorizzazione
          $now = Carbon::now()->format('Y-m-d H:i:s');
          $end = $sponsorship->sponsor_end_at;
          $now_string = strval($now);
          $end_string = strval($end);

          //condizione per resettare o meno la sponsorizzazione
          $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);

          if ($diff) {
            $apartment_is_sponsored = DB::table('apartments')
            ->where('id', $sponsorship->apartment_id)
            ->update(['is_sponsored' => 0]);
          }
        }
      }

      $services = Service::all();
      $lat = $request->latitude;
      $lon = $request->longitude;
      $radius = 20;
      $R = 6371;

      //$place_radius = 5;
      $apartments = DB::table('apartments')
          ->selectRaw('id, title, address, latitude, longitude, is_sponsored, main_img, acos(sin('.$lat.')*sin(radians(latitude)) + cos('.$lat.')*cos(radians(latitude))*cos(radians(longitude)-'.$lon.')) * '.$R.' As distance')
          ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")
          ->orderBy('is_sponsored', 'DESC')
          ->orderBy('distance')
          ->get();

      return view('search_page')->with([
         'apartments'=>$apartments,
         'latitude' => $lat,
         'longitude' => $lon,
         'services'=> $services
      ]);
   }

  public function filters(Request $request){
    //query per aggiornare lo status sponsorizzazione degli appartamenti
    $now_query = Carbon::now();
    $sponsorships = DB::table('sponsorships')
                    ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                    ->where('is_sponsored', 1)
                    ->where('sponsor_end_at', '>', $now_query) //recupero le date di scadenza delle sponsorizzazioni che ancora devono scadere
                    ->get();
    // dd($sponsorships);

    //funzione di reset nel caso in cui la sponsorizzazione sia scaduta
    if ($sponsorships) {
      foreach ($sponsorships as $sponsorship) {
        //controllo tra la data attuale e quella della scadenza dell'ultima sponsorizzazione
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $end = $sponsorship->sponsor_end_at;
        $now_string = strval($now);
        $end_string = strval($end);

        //condizione per resettare o meno la sponsorizzazione
        $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);

        if ($diff) {
          $apartment_is_sponsored = DB::table('apartments')
          ->where('id', $sponsorship->apartment_id)
          ->update(['is_sponsored' => 0]);
        }
      }
    }

   $services = Service::all();
   $apartments = new Apartment;
   if ($request->n_baths > 0 ) {
     $apartments = $apartments
               ->where('n_baths', '<=',$request->n_baths );
   }
   if ($request->n_single_beds > 0 ) {
     $apartments = $apartments
               ->where('n_single_beds', '<=',$request->n_single_beds );
   }
   if ($request->n_double_beds > 0) {
     $apartments = $apartments
               ->where('n_double_beds', '<=',$request->n_double_beds );
   }
 // -------------------------SERVIZI-------------------------
   if (!empty($request->services) ) {
         $apartments = $apartments
         ->whereHas('services', function($q) use ($request) {
                         $q->where('services.name',$request->services);
                     });
   }
 // -------------------------END SERVIZI----------------------
   if ($request->price_per_night > 0) {
     $apartments = $apartments->where('price_per_night', '<=',$request->price_per_night );
   }
   if ($request->latitude > 0 && $request->longitude > 0) {
     $radius = $request->inputRadius;
     if (!$radius>0) {
       $radius = 30;
     }
     $lat = $request->latitude;
     $lon = $request->longitude;
     $R = 6371;
     $apartments = $apartments
             ->selectRaw('id, title, address, latitude, longitude, is_sponsored, main_img, acos(sin('.$lat.')*sin(radians(latitude)) + cos('.$lat.')*cos(radians(latitude))*cos(radians(longitude)-'.$lon.')) * '.$R.' As distance')
             ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")
             ->orderBy('is_sponsored', 'DESC')
             ->orderBy('distance');
   }

    // funzione tom tom originale
    // ->selectRaw('id, title, address, latitude, longitude, is_sponsored, main_img, acos(sin(".$lat.")*sin(radians(latitude)) + cos(".$lat.")*cos(radians(latitude))*cos(radians(longitude)-".$lon.")) * ".$R." As distance')
     // ->whereRaw("acos(sin($lat*0.0175)*sin(radians(latitude)) + cos($lat*0.0175)*cos(radians(latitude))*cos(radians(longitude)-$lon*0.0175)) * $R< $radius")

   $apartments = $apartments->get();
   return view('search_page')->with([
      'apartments'=>$apartments,
      'latitude' => $lat,
      'longitude' => $lon,
      'services'=>$services
      // 'search'=>$search
   ]);
  }

 }
