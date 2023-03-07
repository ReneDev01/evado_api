<?php

namespace App\Http\Controllers\BO;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class OrdersController extends Controller
{
    public function in_progress()
    {
        if(Gate::denies('all-order'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $orders = Order::with('partener', 'customer', 'delever', 'meals')
        ->where('is_taked', true)
        ->where('is_delived', false)
        ->OrderBy('id', 'DESC')
        ->get();
        return view('pages.orders.all_orders', compact('orders'));
    }

    public function delived()
    {
        if(Gate::denies('all-order'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $orders = Order::with( 'partener', 'customer', 'delever', 'meals')
        ->where('is_taked', true)
        ->where('is_delived', true)
        ->OrderBy('id', 'DESC')
        ->get();
        return view('pages.orders.all_orders', compact('orders'));
    }

    public function all()
    {
        if(Gate::denies('all-order'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $orders = Order::with('partener', 'customer', 'delever', 'meals')
        ->OrderBy('id', 'DESC')
        ->get();
        return view('pages.orders.all_orders', compact('orders'));
    }

    public function show($id)
    {
        if(Gate::denies('show-order'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $order = Order::with('partener', 'customer', 'delever', 'meals')
        ->where('id', $id)->first();

        return view('pages.orders.show', compact('order'));
    }
}
