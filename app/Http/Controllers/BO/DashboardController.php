<?php

namespace App\Http\Controllers\BO;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\Delever;
use App\Models\Customer;
use App\Models\Partener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $date_t = date('Y-m-d', strtotime($now));
        $customer_count = Customer::count();
        $total_order = Order::count();
        $total_deliver = Delever::count();
        $total_partener = Partener::count();
        $daily_order = Order::where('order_date', $date_t)->count();
        $daily_order_inProgress = Order::where('order_date', $date_t)
        ->where('is_delived', false)
        ->count();
        $daily_order_delived = Order::where('order_date', $date_t)
        ->where('is_delived', true)
        ->count();
        $daily_active_partener = Partener::where('active', true)
        ->count();
        $year = $now->format('Y');
        $month = $now->format('m');
        $daysCount = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        
        $start_date = date('Y-m-d', strtotime(Carbon::createFromDate($year, $month, 1)));
        $end_date = date('Y-m-d', strtotime(Carbon::createFromDate($year, $month, $daysCount)));
        //$stats = DB::SELECT("SELECT count(*) from orders WHERE order_date BETWEEN "."$start_date"." AND ". "$end_date"." group by order_date");
        $array_cf=[];
        $array_days=[];
        $my_cf = DB::SELECT("SELECT count(*) FROM orders group by order_date ");

        $my_days = DB::SELECT("SELECT DISTINCT order_date FROM orders ");

        foreach ($my_cf as $cf) {
            # code...

            array_push($array_cf, $cf);
        }

        foreach ($my_days as $days) {
            # code...

            array_push($array_days, $days);
        }

        return view("pages.dashboard", compact(
            'customer_count' ,
            'total_order',
            'total_deliver',
            'total_partener',
            'daily_order' ,
            'daily_order_inProgress',
            'daily_order_delived',
            'daily_active_partener',
            'array_days',
            'array_cf',
        )
            
        );
    }
}
