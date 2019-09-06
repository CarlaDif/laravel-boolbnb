<?php

namespace App\Http\Controllers\Upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\User;
use App\Service;
use App\Apartment_img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function createStep1(Request $request)
     {
        $apartment = $request->session()->get('apartment');

        return view('upr.apartment-create-step1', compact('apartment', $apartment));
     }

     public function postCreateStep1(Request $request)
     {
       $user_id = Auth::user()->id;

       $validatedData = $request->validate([
           'title' => 'required',
           'address' => 'required',
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

       $apartment['user_id'] = $user_id;

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
          if(count($array_apartment) < 4) {
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
          if(count($array_apartment) < 8) {
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
        'paths' => 'array|min:4'
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
          //nome del file e storage nel db
          $path = Storage::put('images', $file);

          // $path = Storage::put('images/', $path);
          $row = Apartment_img::insert(
            [
              'path' => $path,
              'apartment_id' => $apartment->id,
              'slug' => Str::slug($path, '-')
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
        $apartment = Apartment::find($apartment_id);

        $apartment_imgs = Apartment_img::where('apartment_id', $apartment_id)->take(4)->get();

        if (!$apartment) {
          abort(404);
        }

        $services = Service::all();

        $data = [
        'apartment' => $apartment,
        'services' => $services,
        'apartment_imgs' => $apartment_imgs
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

    }

}
