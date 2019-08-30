<?php

namespace App\Http\Controllers\upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\User;
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
           'n_single_beds' => 'required|numeric|max:1000',
           'n_double_beds' => 'required|numeric|max:1000',
           'n_baths' => 'required|numeric|max:1000',
           'mq' => 'required'
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
        return view('upr.apartment-create-step3', compact('apartment', $apartment));
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
           'price_per_night' => 'required',
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

       $apartment->save();
       return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
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
