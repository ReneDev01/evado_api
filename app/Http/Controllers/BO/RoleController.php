<?php

namespace App\Http\Controllers\BO;
use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();

        return response()->json([
            "roles" => $roles
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
        $request->validate([
            'slug'=>'required',
            'name'=>'required',
        ]);
        $role = new Role();
        $role->slug = $request->slug;
        $role->name = $request->name;

        $role->save();

        return response()->json([
            'role' => $role
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
        $role = Role::find($id);

        return response()->json([
            "role" => $role
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
        $role = Role::find($id);

        return response()->json([
            "role" => $role
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $role = Role::find($id);

        $role->update([
            "name" => $request->name,
            "slug" => $request->slug,
        ]);

        return response()->json([
            "role" => $role
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
