<?php

namespace App\Http\Controllers\BO;
use Carbon\Carbon;

use App\Models\Pub;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class PubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pubs = Pub::with('partener')->get();
        return view('pages.pubs.index', compact('pubs'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-promo'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $parteners = Partener::all();
        return view('pages.pubs.create', compact("parteners"));
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
            'description' => 'required',
            'partener_id' => 'required',
        ]);

        if($request->hasFile('image')){
            $pub = new Pub();
            $image = $request->file('image');
            $pub->description = $request->description;
            $pub->partener_id = $request->partener_id;
            $pub->percent = $request->percent;
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/pubs');
            $image->move($destinationPath, $img_name);
            $pub->image = 'images/pubs/'.$img_name;
        }

        $pub->save();

        Toastr()->success('Publicitée enrégistrée avec succès!', 'Save Pubs');
        return redirect('/pubs');
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
        if(Gate::denies('edit-promo'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $parteners = Partener::all();
        $pub = Pub::find($id);

        return view('pages.pubs.edit',compact('pub', 'parteners'));
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

        $pub = Pub::find($id);
    
        $pub->description = $request->description;
        $pub->partener_id = $request->partener_id;
        $pub->percent = $request->percent;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/pubs');
            $image->move($destinationPath, $img_name);
            $pub->logo = 'images/pubs/'.$img_name;
        }
        $pub->save();

        Toastr()->success('Publicitée mise à jour avec succès!', 'Update pubs');
        return redirect('/pubs');
    }

    public function activeOrDesactive($id)
    {
        if(Gate::denies('active-promo'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $getActive = Pub::select('is_active')->where('id',$id)->first(); 
        if($getActive->is_active == 0)
        {
            $active = 1;
            Pub::where('id',$id)->update(['is_active' => $active]);

            Toastr()->success('Pub activé avec succès!', 'Active Pub');
            return redirect()->back();
        }else{
            $active = 0;
            Pub::where('id',$id)->update(['is_active' => $active]);

            Toastr()->success('Pub désactivé avec succès!', 'Active Pub');
            return redirect()->back();
        }
    }

    public function promote($id)
    {
        if(Gate::denies('makeIt-promo'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $getPromotion = Pub::select('promotion')->where('id',$id)->first(); 
        if($getPromotion->promotion == 0)
        {
            $promotion = 1;
            Pub::where('id',$id)->update(['promotion' => $promotion]);

            Toastr()->success('Promo activé avec succès!', 'Promote Pub');
            return redirect()->back();
        }else{
            $promotion = 0;
            Pub::where('id',$id)->update(['promotion' => $promotion]);

            Toastr()->success('Promo desactivé avec succès!', 'Promote Pub');
            return redirect()->back();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pub $pub)
    {
        //
        $pub-> delete();

        Toastr()->success('Publicitée supprimée avec succès!', 'Delete pubs');
        return redirect('/pubs');
    }
}
