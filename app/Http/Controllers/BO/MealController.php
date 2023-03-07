<?php

namespace App\Http\Controllers\BO;
use Redirect;
use Carbon\Carbon;
use App\Models\Meal;
use App\Models\Group;
use App\Models\Category;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\Facades\Meal;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Gate::denies('all-meal'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $partener = Partener::where('id', $id)->first();
        
        $meals = Meal::with('group')->where('partener_id', $partener->id)

        ->get();
        return view('pages.meals.index', compact('meals', 'partener'));
    }

    //latest meals

    public function latestMeals()
    {
        $now = Carbon::now();
        $date = date('Y-m-d mm:ss', strtotime($now . ' - 7 days'));
        return response(
            Meal::whereDate('created_at', '>', $date)->with('partener', 'category')->withOut('group')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($partener_id)
    {
        if(Gate::denies('create-meal'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $partener = Partener::find($partener_id);

        $groups = Group::where('partener_id', $partener_id)->get();

        return view('pages.meals.create', compact('partener', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $partener_id)
    {
        //dd($request);
        $partener = Partener::find($partener_id);

        $request ->validate([
            'name'=>'required',
            'slug'=>'required',
            'price'=>'required',
            'image'=>'required',
            'description'=>'required',
            'group_id'=>'required',
            'cooking_time'=>'required',
        ]);
            
            //dd($partener);
            if($partener)
            {
                $meal = new Meal();
                $meal->name = $request->name;
                $meal->slug = $request->slug;
                $meal->price = $request->price;
                $meal->cooking_time = $request->cooking_time;
                $image = $request->file('image');
                $meal->description = $request->description;
                $meal->partener_id = $partener->id;
                $meal->group_id = $request->group_id;

                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $img_name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('images/meals');
                    $image->move($destinationPath, $img_name);
                    $meal->image = 'images/meals/'.$img_name;
                }
            
                //dd($meal);
            $meal->save();
            
            Toastr()->success('Produit enrégistré avec succès!', 'Save Meal');
            return redirect('partener/'.$partener->id.'/meals');
            
            }else{
                Toastr()->error('Produit non enrégistré ', 'Save Meal');
                return redirect()->back();
            }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $partener_id)
    {
        $partener = Partener::find($partener_id);
        $meal = Meal::find($id);

        return redirect('meals.show', compact('meal', 'partener'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('edit-meal'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $meal = Meal::where('id', $id)->first();

        $groups = Group::where('partener_id', $meal->partener_id)->get();

        return view('pages.meals.edit', compact('meal','groups'));
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
        $meal = Meal::find($id);
            $meal->name = $request->name;
            $meal->slug = $request->slug;
            $meal->price = $request->price;
            $meal->cooking_time = $request->cooking_time;
            $meal->description = $request->description;

            $meal->group_id = $request->group_id;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $img_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('images/meals');
                $image->move($destinationPath, $img_name);
                $meal->image = 'images/meals/'.$img_name;
            }
            $meal->save();

            Toastr()->success('Produit mise à jour avec succès!', 'Update Meal');
            return redirect('partener/'.$meal->partener_id.'/meals');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-meal'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $meal = Meal::find($id);
        $meal->delete();
        Toastr()->success('Produit supprimé avec succès!', 'Delete Meal');
        return redirect('partener/'.$meal->partener_id.'/meals');
         
    }
}
