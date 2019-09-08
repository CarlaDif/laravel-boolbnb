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

 public function page(Request $request ){

   $validatedData = $request->validate([
       'search' => 'required',
   ]);
     $apartments = Apartment::all();
     $search = $request->search;

     return view('search_page')->with([
       'apartments'=>$apartments,
       'search'=>$search
     ]);

 }

}
