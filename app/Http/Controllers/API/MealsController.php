<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Meal;

class MealsController extends Controller
{
    public function latestMeals()
    {   
        return response(
            Meal::with('partener','group')->orderBy("id", "desc")->take(12)->get()
        );
    }

    public function mealShow($id)
    {
        $meal = Meal::with('partener')->where('id', $id)->first();
        return response($meal);
    }
    
}
