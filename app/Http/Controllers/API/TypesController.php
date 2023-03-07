<?php

namespace App\Http\Controllers\API;

use App\Models\Type;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    public function typeList()
    {
        $types = Type::all();
        return response($types);
    }

    public function typePartener($id)
    {
        $parteners = Partener::where('type_id', $id)->get();
        return response($parteners);
    }
}
