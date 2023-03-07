<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use LengthException;
use App\Models\Order;
use App\Models\Delever;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeliversController extends Controller
{

    public function takeOrder($id)
    {
        $getOrder = Order::select('is_taked')->where('id',$id)->first(); 
        if($getOrder->is_taked == 0)
        {
            $is_taked = 1;
            $take = Order::where('id',$id)->update(
                [
                    'is_taked' => $is_taked,
                    'delever_id' => Auth::user()->id
                ]
            );
        }else{
            $is_taked = 0;
            $take = Order::where('id',$id)->update(
                [
                    'is_taked' => $is_taked,
                    'delever_id' => Null
                ]
            );
        }

        return response($getOrder);
    }

    public function deliverOrder()
    {
        $orders = Order::with('partener', 'meals', 'customer', 'place')
        ->where('delever_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function order_delived($id)
    {
        $order = order::where('id', $id)->first();
        $delever = Delever::where('id', Auth::user()->id)->first();

        return response([
            $order->update([
                'is_delived' => true
            ]),
            
            $delever->update([
                'solde' => $delever->solde + ($order->delever_price*0.60)
            ])
        ]);
    }

    public function deliver_stat()
    {
        $now = Carbon::now();
        $date = date('Y-m-d', strtotime($now));

        $daily_order_delived = Order::where('order_date', $date)
        ->where('delever_id', Auth::user()->id)
        ->where('is_delived', true)
        ->count();

        $all_delived = Order::where('delever_id', Auth::user()->id)
        ->where('is_delived', true)
        ->count();

        $orders = Order::where('delever_id', Auth::user()->id)
        ->where('is_delived', true)
        ->get();

        $total = 0;
        foreach ($orders as $order) {
            $total = $total + $order->delevery_price; 
        }

        $daily_ordres = $orders = Order::where('order_date', $date)
        ->where('delever_id', Auth::user()->id)
        ->where('is_delived', true)
        ->get();

        $daily_total = 0;
        foreach ($daily_ordres as $order) {
            $daily_total = $daily_total + $order->delevery_price; 
        }

        $year = $now->format('Y');
        $month = $now->format('m');
        $daysCount = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        
        $ordersData = Order::where('delever_id', Auth::user()->id)
        ->whereBetween('created_at', [Carbon::createFromDate($year, $month, 1), Carbon::createFromDate($year, $month, $daysCount)])
        ->selectRaw('DAYOFMONTH(created_at) monthDay,count(*)')
        ->groupBy('monthDay')
        ->get();
        

        return response()->json([
           'daily_order' => $daily_order_delived,
           'all_delever' => $all_delived,
           'total' => $total,
           'daily_total' => $daily_total,
           'ordersData' => $ordersData,
        ]);
    }

}
