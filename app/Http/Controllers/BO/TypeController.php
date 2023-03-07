<?php

namespace App\Http\Controllers\BO;
use App\Http\Controllers\Controller;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $types = Type::all();

        return view("pages.types.index", compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation 
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'image'=>'required'
        ]);
        
        if($request->hasFile('image')){
            $type = new Type();
            $image = $request->file('image');
            $type->name = $request->name;
            $type->slug = $request->slug;

            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/types');
            $image->move($destinationPath, $img_name);
            $type->image = 'images/types/'.$img_name;
        }

        $type->save();

        Toastr()->success('Type enrégistré avec succès!', 'Save type');
        return redirect("/types");

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
        if(Gate::denies('edit-type'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $type = Type::find($id);

        return view('pages.types.edit', compact('type'));
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
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $type = Type::find($id);

        $type->name = $request->name;
        $type->slug = $request->slug;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/types');
            $image->move($destinationPath, $img_name);
            $type->image = 'images/types/'.$img_name;
        }
        //dd($type);

        $type->save();

        Toastr()->success('Type mise à jour avec succès!', 'Update type');
        return redirect("/types");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if(Gate::denies('delete-type'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $type->delete();
        Toastr()->success('Type Supprimer avec succès!', 'Delete type');
        return redirect("/types");
    }
}
