<?php

namespace App\Http\Controllers\API;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $places = Place::where('customer_id', Auth::user()->id)->get();

        return response($places);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'adress' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'description' => 'required',
        ]);

        $customer = Auth::user();

        if($customer != null){
            $place = new place();

            $place->adress = $request->adress;
            $place->longitude = $request->longitude;
            $place->latitude = $request->latitude;
            $place->description = $request->description;
            $place->customer_id = Auth::user()->id;
            
            $place->save();

            return response()->json([
                'place' => $place
            ], 200);
        }else{
            return "Connectez-vous";
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $place = Place::find($id);

        return response()->json([
            "place" => $place
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return response($place);
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
        //
        $request -> validate([
            'adress' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'description' => 'required',
            'customer_id' => 'required',
        ]);

        $place = Place::find($id);

        $place->update([
           "adress" => $request->adress,
           "longitude" => $request->longitude,
           "latitude" => $request->latitude,
           "description" => $request->description,
           "customer_id" => Auth::user()->id,
        ]);

        return response()->json([
            "place" => $place
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
    }
}
