<?php

namespace App\Http\Controllers\BO;
use App\Models\Meal;

use App\Models\Promo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promos = Promo::with('meal')->get();

        return view('pages.promos.index', compact('promos'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::define('create-promo', function ($user){
            return $user->IsSuperviser;
        });
        $meals = Meal::all();
        return view('pages.promos.create', compact('meals'));
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
            'description' => 'required',
            'date_debut'=> 'required|date',
            'date_fin'=> 'required|date',
            'meal_id' => 'required',
        ]);

        $promo = new promo();

        $promo->percent = $request->percent;
        $promo->user_id = $request->user_id;
        $promo->description = $request->description;
        $promo->date_debut = $request->date_debut;
        $promo->date_fin = $request->date_fin;
        $promo->meal_id = $request->meal_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/meals');
            $image->move($destinationPath, $img_name);
            $promo->image = 'images/meals/'.$img_name;
        }
        $promo->save();

        Toastr()->success('Promos enrégistrée avec succès!', 'Save promos');
        return redirect('/promos');
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
        Gate::define('edit-promo', function ($user){
            return $user->IsSuperviser;
        });
        $meals = Meal::all();
        $promo = Promo::find($id);

        return view('pages.promos.edit', compact('promo', 'meals'));
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
            'description' => 'required',
            'date_debut'=> 'required|date',
            'date_fin'=> 'required|date',
            'meal_id' => 'required',
        ]);

        $promo = Promo::find($id);

        $promo->percent = $request->percent;
        $promo->user_id = $request->user_id;
        $promo->description = $request->description;
        $promo->date_debut = $request->date_debut;
        $promo->date_fin = $request->date_fin;
        $promo->meal_id = $request->meal_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/meals');
            $image->move($destinationPath, $img_name);
            $promo->image = 'images/meals/'.$img_name;
        }
        $promo->save();

        Toastr()->success('Promo mise à jour avec succès!', 'update promo');
        return redirect('/promos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        Gate::define('delete-promo', function ($user){
            return $user->IsSuperviser;
        });
        $promo-> delete();

        Toastr()->success('Promo supprimé avec succès!', 'Delete promo');
        return redirect('/promos');
    }
}
