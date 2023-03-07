<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function customerAuth(Request $request)
    {
        $request->validate([
          'phone' => 'required|phone:TG',
          'code' => 'required'
        ]);

        
    }

    public function deleverAuth(Request $request)
    {

    }

    public function userAuth(Request $request)
    {

    }
}
