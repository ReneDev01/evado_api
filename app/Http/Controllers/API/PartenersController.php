<?php

namespace App\Http\Controllers\API;


use App\Models\Meal;
use App\Models\Group;
use App\Models\Order;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PartenersController extends Controller
{
    public function getParteners()
    {
        $parteners = Partener::without('meals', 'type')->where('active', true)->get();
        return response($parteners);
    }

    public function partenerGroups($id){
        $groups = Group::with('meals', 'partener')->where('partener_id', $id)->get();
        return response($groups);
    }

    public function partenerGroupMeal($id)
    {
        $meals = Meal::where('group_id', $id)->with('partener')->get();
        return response($meals);
    }

    public function partenerAllMeals($id){
        return response(Meal::with('partener')->where('partener_id', $id)->without('group')->get());
    }

    public function partener_order()
    {
        $orders = Order::with('partener', 'meals')
        ->where('partener_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function confirmed_order($id)
    {
        $order = Order::where('id', $id)
        ->first();
        $order->update([
            "is_confirmed" => true
        ]);
        return response(
            "Commande confirmer avec succes!"
        );
    }

    public function order_in_progress()
    {
        $orders = Order::with('partener', 'meals')
        ->where('partener_id', Auth::user()->id)
        ->where('is_confirmed', false)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function order_delived()
    {
        $orders = Order::with('partener', 'meals')
        ->where('is_confirmed', true)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function partener_stat()
    {
        $now = Carbon::now();
        $date = date('Y-m-d', strtotime($now));

        $daily_order_delived = Order::with('meals')
        ->where('order_date', $date)
        ->where('partener_id', Auth::user()->id)
        ->where('is_confirmed', true)
        ->count();

        $all_delived = Order::with('meals')
        ->where('partener_id', Auth::user()->id)
        ->where('is_confirmed', true)
        ->count();

        $orders = Order::where('partener_id', Auth::user()->id)
        ->where('is_confirmed', true)
        ->with('meals')
        ->get();

        $total = 0;
        foreach ($orders as $order) {

            foreach ($order->meals as $meal) {
                # code...
                $total = $total + ($meal->price*$meal->pivot->quantity);
            }
             
        }

        $daily_ordres = Order::with('meals')
        ->where('order_date', $date)
        ->where('partener_id', Auth::user()->id)
        ->where('is_confirmed', true)
        ->get();

        $daily_total = 0;
        foreach ($daily_ordres as $order) {
            foreach ($order->meals as $meal) {
                # code...
                $daily_total = $daily_total + ($meal->price*$meal->pivot->quantity); 
            }
            
        }

        $year = $now->format('Y');
        $month = $now->format('m');
        $daysCount = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        
        $ordersData = Order::where('partener_id', Auth::user()->id)
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
