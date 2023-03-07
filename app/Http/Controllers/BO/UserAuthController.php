<?php

namespace App\Http\Controllers\BO;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
       $credentials = $request->validate([
            'phone' => 'required|phone:TG',
            'password' => 'required',
        ]);
        

        if(!Auth::guard('web')->attempt($credentials)){
            Toastr()->success('Réessayer avec les bonnes informations', 'Login User');
            return redirect("/login");
        }else{
            Toastr()->warning('Travailler en toute sécurité', 'Login User');
            return redirect("/dashboard");
        }

        
    } 

    public function index()
    {
        return view("auth.login");
    }

    //logout
    public function logout()
    {
        auth()->logout();
        // redirect to homepage
        return redirect('login');
    }
}
