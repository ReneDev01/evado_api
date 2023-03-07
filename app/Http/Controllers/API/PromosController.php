<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Promo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromosController extends Controller
{
    public function latestPromos()
    {
        $now = Carbon::now();
        $date = date('Y-m-d mm:ss', strtotime($now . ' - 7 days'));

        //info($date);
        $promos = Promo::whereDate('created_at', '>', $date)->get();
        return response($promos);
    }
}
