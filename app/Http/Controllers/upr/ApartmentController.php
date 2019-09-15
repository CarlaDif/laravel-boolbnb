<?php

namespace App\Http\Controllers\Upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\User;
use App\Service;
use App\Apartment_img;
use App\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myIndex()
    {
      //query per aggiornare lo status sponsorizzazione degli appartamenti
      $sponsorships = DB::table('sponsorships')
                      ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                      ->select('sponsorships.*')
                      ->orderBy('apartment_id', 'ASC')
                      ->orderBy('sponsor_end_at', 'DESC')
                      ->get();

      $now = Carbon::now()->format('Y-m-d H:i:s');

      foreach ($sponsorships as $sponsor) {
        $end = $sponsor->sponsor_end_at;
        $now_string = strval($now);
        $end_string = strval($end);

        $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);
        if ($diff) {
          $apartment_is_sponsored = DB::table('apartments')
          ->where('id', $sponsor->apartment_id)
          ->update(['is_sponsored' => 0]);
        }
      }

      $apartments = Apartment::where('user_id', Auth::user()->id)->orderBy('is_sponsored', 'DESC')->get();
      return view('upr.myapartments', compact('apartments', $apartments));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function createStep0(Request $request)
     {
        $apartment = $request->session()->get('apartment');

        return view('upr.apartment-create-step0', compact('apartment', $apartment));
     }

     public function postCreateStep0(Request $request)
     {
       $user_id = Auth::user()->id;

       $validatedData = $request->validate([
           'address' => 'required',
           'latitude' => 'required',
           'longitude' => 'required',
       ]);

       if(empty($request->session()->get('apartment'))){
           $apartment = new Apartment();
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }else{
           $apartment = $request->session()->get('apartment');
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }

       $apartment['user_id'] = $user_id;

       return redirect('/apartment/create-step1');
     }

     public function createStep1(Request $request)
     {
        $apartment = $request->session()->get('apartment');
        //inserisco i dati recuperati in un array
        if(!empty($apartment)) {
          $array_apartment = $apartment->toArray();
          //verifico che i dati recuperati dalla precedente sessione, siano tutti i dati che mi servono per proseguire
          //se i dati non sono sufficenti
          if(count($array_apartment) < 4) {
            Session::flash('message', 'Devi prima compilare tutti i campi del form!');
            return redirect()->route('upr.apartments.create-step1');
          }
        } elseif (!$apartment) {
          Session::flash('message', 'Devi prima compilare tutti i campi del form!');
          return redirect()->route('upr.apartments.create-step1');
        }

        return view('upr.apartment-create-step1', compact('apartment', $apartment));
     }

     public function postCreateStep1(Request $request)
     {

       $validatedData = $request->validate([
           'title' => 'required',
           'description' => 'required',
       ]);

       if(empty($request->session()->get('apartment'))){
           $apartment = new Apartment();
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }else{
           $apartment = $request->session()->get('apartment');
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }

       return redirect('/apartment/create-step2');
     }

     public function createStep2(Request $request)
     {
        //recupero dati sessione precedente
        $apartment = $request->session()->get('apartment');

        //inserisco i dati recuperati in un array
        if(!empty($apartment)) {
          $array_apartment = $apartment->toArray();
          //verifico che i dati recuperati dalla precedente sessione, siano tutti i dati che mi servono per proseguire
          //se i dati non sono sufficenti
          if(count($array_apartment) < 6) {
            Session::flash('message', 'Devi prima compilare tutti i campi del form!');
            return redirect()->route('upr.apartments.create-step1');
          }
        } elseif (!$apartment) {
          Session::flash('message', 'Devi prima compilare tutti i campi del form!');
          return redirect()->route('upr.apartments.create-step1');
        }
        //se i dati sono sufficenti si procede allo step successivo
        return view('upr.apartment-create-step2', compact('apartment', $apartment));
     }

     public function postCreateStep2(Request $request)
     {
       $validatedData = $request->validate([
           'n_rooms' => 'numeric|min:0',
           'n_single_beds' => 'required|numeric|min:0|max:1000',
           'n_double_beds' => 'required|numeric|min:0|max:1000',
           'n_baths' => 'required|numeric|min:1|max:1000',
           'mq' => 'required|min:0',
       ]);

       if(empty($request->session()->get('apartment'))){
           $apartment = new Apartment();
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }else{
           $apartment = $request->session()->get('apartment');
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }

       return redirect('/apartment/create-step3');
     }

     public function createStep3(Request $request)
     {
        $apartment = $request->session()->get('apartment');
        $services = Service::all();
        $data = [
        'apartment' => $apartment,
        'services' => $services
        ];

        //inserisco i dati recuperati in un array
        if(!empty($apartment)) {
          $array_apartment = $apartment->toArray();
          //verifico che i dati recuperati dalla precedente sessione, siano tutti i dati che mi servono per proseguire
          //se i dati non sono sufficenti
          if(count($array_apartment) < 11) {
            Session::flash('message', 'Devi prima compilare tutti i campi del form!');
            return redirect()->route('upr.apartments.create-step2');
          }
        } elseif (!$apartment) {
          Session::flash('message', 'Devi prima compilare tutti i campi del form!');
          return redirect()->route('upr.apartments.create-step1');
        }
        //se i dati sono sufficenti si procede allo step successivo
        return view('upr.apartment-create-step3', $data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
          'price_per_night' => 'required|min:0',
          'services' => 'required',
          'main_img' => 'required|image',
          'is_public' => 'required|boolean',
       ]);

      $validatedImages = $request->validate([
        'paths' => 'required|array|min:4'
      ]);

      //path dell'img (percorso images/nome-file.estensione)
      $img = Storage::put('images', $validatedData['main_img']);

      $input = $request->all();

      if(empty($request->session()->get('apartment'))){
        $apartment = new Apartment();
        $apartment->fill($validatedData);
        $request->session()->put('apartment', $apartment);
      }else{
        $apartment = $request->session()->get('apartment');
        $apartment->fill($validatedData);
        $request->session()->put('apartment', $apartment);
      }

      $apartment->main_img = $img;

      $paths = array();

      $apartment->save();

      //salvataggio img nel database
      if($files = $request->file('paths')){
        foreach($files as $file){

          $img_name = $file->getClientOriginalName();

          //nome del file e storage nel db
          $path = Storage::put('images', $file);

          // $path = Storage::put('images/', $path);
          $row = Apartment_img::insert(
            [
              'path' => $path,
              'apartment_id' => $apartment->id,
              'slug' => Str::slug($img_name, '-')
            ]);
        }
      }

      //sincronizzo i servizi dell'appartamento
      $apartment->services()->sync($validatedData['services']);
      return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($apartment_id)
    {
      //query per aggiornare lo status sponsorizzazione degli appartamenti
      $sponsorship = DB::table('sponsorships')
                      ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                      ->select('sponsorships.*')
                      ->orderBy('sponsor_end_at', 'DESC')
                      ->first();

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $end = $sponsorship->sponsor_end_at;
        $now_string = strval($now);
        $end_string = strval($end);

        $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);

        if ($diff) {
          $apartment_is_sponsored = DB::table('apartments')
          ->where('id', $apartment_id)
          ->update(['is_sponsored' => 0]);
        }

        $apartment = Apartment::find($apartment_id);

        $apartment_imgs = Apartment_img::where('apartment_id', $apartment_id)->take(4)->get();

        $sponsorships = Sponsorship::where('apartment_id', $apartment_id)->get();

        if (!$apartment) {
          abort(404);
        }

        $services = Service::all();

        $data = [
        'apartment' => $apartment,
        'services' => $services,
        'apartment_imgs' => $apartment_imgs,
        'sponsorships' => $sponsorships
        ];

        return view('apartmentdetail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit($apartment_id)
    {
      $apartment = Apartment::find($apartment_id);
      //se l'id appartamento non esiste all'interno della tabella degli appartamenti
      $check = DB::table('apartments')->pluck('id')->toArray();

      if(!in_array($apartment_id, $check) || $apartment->user_id != Auth::user()->id) {
        abort(404);
      } else {
        $apartment = Apartment::find($apartment_id);
        $services = Service::all();
        $apartment_services = DB::table('apartment_service')->where('apartment_id', $apartment_id)->get();

        $data = [
          'apartment' => $apartment,
          'services' => $services,
          'apartment_services' => $apartment_services
        ];

        return view('upr.apartment-edit', $data);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $apartment_id)
    {
      $validatedData = $request->validate([
        'title' => 'required',
        'address' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'description' => 'required',
        'n_rooms' => 'numeric|min:1',
        'n_single_beds' => 'required|numeric|min:0|max:1000',
        'n_double_beds' => 'required|numeric|min:0|max:1000',
        'n_baths' => 'required|numeric|min:1|max:1000',
        'mq' => 'required|min:0',
        'price_per_night' => 'required|integer|min:1',
        'services' => 'required',
        'main_img' => 'required|image',
        'is_public' => 'required|boolean'
      ]);

      $apartment = Apartment::find($apartment_id);

      //path img images/nome-file.estensione
      $img = Storage::put('images', $validatedData['main_img']);

      //assegnazione path esatta da salvare nel db
      $validatedData['main_img'] = $img;

      //salvataggio img nel database
      if($files = $request->file('paths')){
        foreach($files as $file){

          $img_name = $file->getClientOriginalName();

          //nome del file e storage nel db
          $path = Storage::put('images', $file);

          // $path = Storage::put('images/', $path);
          $row = Apartment_img::insert(
            [
              'path' => $path,
              'apartment_id' => $apartment->id,
              'slug' => Str::slug($img_name, '-')
            ]);
        }
      }

      $apartment->services()->sync($validatedData['services']);

      //aggiornamento dati
      $apartment->update($validatedData);

      return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
      if (empty($apartment)) {
        abort(404);
      }

      if ($apartment->user_id != Auth::user()->id) {
        abort(403, 'Unauthorized action.');
      }

      $apartment = Apartment::find($apartment->id);
      $apartment->delete();
      return redirect()->route('upr.my-apartments');

    }

    public function statistics(Request $request, $apartment_id) {
      //query per aggiornare lo status sponsorizzazione degli appartamenti
      $sponsorship = DB::table('sponsorships')
                      ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                      ->select('sponsorships.*')
                      ->orderBy('sponsor_end_at', 'DESC')
                      ->first();

      $now = Carbon::now()->format('Y-m-d H:i:s');

      $end = $sponsorship->sponsor_end_at;
      $now_string = strval($now);
      $end_string = strval($end);

      $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);
      if ($diff) {
        $apartment_is_sponsored = DB::table('apartments')
        ->where('id', $apartment_id)
        ->update(['is_sponsored' => 0]);
      }

      $apartment = Apartment::find($apartment_id);
      $sponsors = Sponsorship::where('apartment_id', $apartment_id)
      ->orderBy('created_at', 'DESC')
      ->get();
      $somma = 0;

      foreach ($sponsors as $sponsor) {
        $tipo_sponsor = $sponsor->sponsor_type_id;
        // $end = Carbon::parse($sponsor->sponsor_end_at)->format('d-m-Y');
        // $orario_end = Carbon::parse($sponsor->sponsor_end_at)->format('H:i');

        if ($tipo_sponsor == '1') {
          $costo = '2.99';
        } elseif ($tipo_sponsor == '2') {
          $costo = '5.99';
        } else {
          $costo = '9.99';
        }

        $somma += $costo;
      }

      $end = Carbon::parse($end_string)->format('d-m-Y');
      $orario_end = Carbon::parse($end_string)->format('H:i');

      $data = [
        'apartment' => $apartment,
        'sponsors' => $sponsors,
        'somma' => $somma,
        'end' => $end,
        'orario_end' => $orario_end,
      ];

      return view('upr.statistics', $data);
    }

}
