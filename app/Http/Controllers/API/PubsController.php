<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Pub;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PubsController extends Controller
{
    public function latestPubs()
    {
        return response(Pub::where('promotion', true)->get());
    }


    public function promo()
    {
        $pub = Pub::where('is_active', true)->first();
        return response($pub);
    } 
}
