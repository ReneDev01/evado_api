<?php

namespace App\Http\Controllers\BO;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customer_count = Customer::count();
        $customers = Customer::all();
        return view('pages/customers/index', compact('customers', 'customer_count'));
    }

    public function operate($id)
    {
        $customer = Customer::with('operations')
        ->where('id', $id)
        ->first();

        return view('pages/customers/operation', compact('customer'));
    }
}
