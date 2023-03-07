<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $informations = Information::all();

        return response()->json([
            "informations" => $informations
        ], 200);
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
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'required',
        ]);

        $information = new Information();

        $information->name = $request->name;
        $information->surname = $request->surname;
        $information->image = $request->image;
        $information->birthday = $request->birthday;
        $information->customer_id = $request->customer_id;
        
        $information->save();

        return response()->json([
            'information' => $information
        ], 200);
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
        $information = Information::find($id);

        return response()->json([
            "information" => $information
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
        //
        $information = Information::find($id);

        return response() -> json([
            "information" => $information
        ], 200);
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
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'required',
        ]);

        $information = Information::find($id);

        $information->update([
           "name" => $request->name,
           "surname" => $request->surname,
           "image" => $request->image,
           "birthday" => $request->birthday,
           "customer_id" => $request->customer_id,
        ]);

        return response()->json([
            "information" => $information
        ], 200);
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
