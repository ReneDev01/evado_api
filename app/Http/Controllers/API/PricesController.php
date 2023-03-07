<?php

namespace App\Http\Controllers\API;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricesController extends Controller
{
    public function index()
        {
            $price = Price::first();
            return response($price);
        }
}
