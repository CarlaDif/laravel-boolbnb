<?php

namespace App\Http\Controllers\Upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\User;
use App\Service;
use Illuminate\Http\Request;

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
        $apartment = $request->session()->get('apartment');
        return view('upr.apartment-create-step2', compact('apartment', $apartment));
     }

     public function postCreateStep2(Request $request)
     {

       $validatedData = $request->validate([
           'n_rooms' => 'numeric|min:0',
           'n_single_beds' => 'required|numeric|min:0|max:1000',
           'n_double_beds' => 'required|numeric|min:0|max:1000',
           'n_baths' => 'required|numeric|min:1|max:1000',
           'mq' => 'required|min:0'
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
           'services' => 'required'
       ]);

       if(empty($request->session()->get('apartment'))){
           $apartment = new Apartment();
           $apartment->fill($validatedData);
           $request->session()->put('apartment', $apartment);
       }else{
           $apartment = $request->session()->get('apartment');
           $apartment->fill($validatedData);
           $apartment->is_public = '1';
           $request->session()->put('apartment', $apartment);
       }

       // // dd($apartment);
       // dd($service);

       $apartment->save();
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
        $services = Service::all();
//
// $posts = Post::where('category_id', $category->id)->get();
        $data = [
        'apartment' => $apartment,
        'services' => $services
        ];

        return view('apartmentdetail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
