<?php

namespace App\Http\Controllers\BO;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PromotionsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       //
       $promotions = Promotion::all();

       return view('pages.promotions.index', compact('promotions'));
   
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       Gate::define('create-promotion', function ($user){
           return $user->IsSuperviser;
       });
       return view('pages.promotions.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       //
       $request -> validate([
           'percent' => 'required',
           'slug' => 'required',
           'code'=> 'required',

       ]);

       $promotion = new Promotion();

       $promotion->percent = $request->percent;
       $promotion->slug = $request->slug;
       $promotion->code = $request->code;

       $promotion->save();

       Toastr()->success('promotions enrégistrée avec succès!', 'Save promotions');
       return redirect('/promotions');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       Gate::define('edit-promotion', function ($user){
           return $user->IsSuperviser;
       });
       $promotion = Promotion::find($id);

       return view('pages.promotions.edit', compact('promotion'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       $request -> validate([
           'percent' => 'required:number',
           'slug' => 'required',
           'code'=> 'required',
       ]);

       $promotion = Promotion::find($id);

       $promotion->percent = $request->percent;
       $promotion->slug = $request->slug;
       $promotion->code = $request->code;
       $promotion->save();

       Toastr()->success('promotion mise à jour avec succès!', 'update promotion');
       return redirect('/promotions');
   }

   public function activeOrDesactive($id)
   {
       if(Gate::denies('active-promo'))
       {
           Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
           return redirect('/dashboard');
       }
       $getActive = Promotion::select('isActive')->where('id',$id)->first(); 
       if($getActive->active == 0)
       {
           $active = 1;
           Promotion::where('id',$id)->update(['isActive' => $active]);

           Toastr()->success('Partenaire activé avec succès!', 'Active partener');
       return redirect()->back();
       }else{
           $active = 0;
           Promotion::where('id',$id)->update(['isActive' => $active]);

           Toastr()->success('Partenaire Désactivé avec succès!', 'Active partener');
           return redirect()->back();
       }

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Promotion $promotion, $id)
   {
       Gate::define('delete-promotion', function ($user){
           return $user->IsSuperviser;
       });
       $promotion = Promotion::find($id);
       $promotion-> delete();

       Toastr()->success('promotion supprimé avec succès!', 'Delete promotion');
       return redirect('/promotions');
   }
}
