<?php

namespace App\Http\Controllers\BO;

use App\Models\Pub;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PriceController extends Controller
{
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            if(Gate::denies('all-price'))
            {
                Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
                return redirect('/dashboard');
            }
            $prices = Price::all();
    
            return view('pages.prices.index', compact('prices'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            if(Gate::denies('create-price'))
            {
                Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
                return redirect('/dashboard');
            }
            return view('pages.prices.create');
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
            $request->validate([
                'price' => 'required',
            ]);

            $price = new Price();
            $price->price = $request->price;

    
            $price->save();
            Toastr()->success('Catégorie enrégistré avec succès!', 'Save price');
            return redirect('/prices');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            if(Gate::denies('edit-price'))
            {
                Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
                return redirect('/dashboard');
            }
    
            $price = Price::find($id);
    
            return view('pages.prices.edit', compact('price'));
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
    
            $price = Price::find($id);

            $price->price = $request->price;

            $price->save();
    
            Toastr()->success('Catégorie mise à jour avec succès!', 'Update price');
            return redirect('/prices');
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    
    
}
