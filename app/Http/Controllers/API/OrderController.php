<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\Delever;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('partener', 'meals', 'place','customer')
        ->where('customer_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function in_progress()
    {
        $orders = Order::with('partener', 'meals', 'place','customer')
        ->where('is_delived', false)
        ->where('customer_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function delived()
    {
        $orders = Order::with('partener', 'place', 'customer', 'meals')
        ->where('is_delived', true)
        ->where('customer_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function all()
    {
        $orders = Order::with('partener', 'place', 'customer', 'meals')->OrderBy('id', 'DESC')->get();
        return response($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function not_taked()
    {
        $orders = Order::with('partener','place', 'customer', 'meals')
        ->where('is_taked', false)
        ->OrderBy('id', 'DESC')
        ->get();
        return response($orders);
    }

    public function show($id)
    {
        $order = Order::with('partener', 'customer', 'delever', 'meals')
        ->where('id', $id)->first();
        return response($order);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delevers = Delever::all();
        $order_code = $this->generateSmsCode(6);
        $order = new Order();
        $customer = Auth::user();
        //$promo = Promotion::where('isActive', true)->where('code', $request->code)->first();
        $now = Carbon::now();
        $date = $now->format('Y-m-d');
        if($customer->solde > $request->delevery_price){

                $order->customer_id = Auth::user()->id;
                $order->order_date = $date;
                $order->code = $order_code;
                $order->delevery_price = $request->delevery_price;
                $order->longitude = $request->longitude;
                $order->latitude = $request->latitude;
                $order->place_id = $request->place_id;
                $order->partener_id = $request->partener_id;
                $order->delever_id = $request->delever_id;
                $order->date = $request->date;
                $order->phone = $request->phone;
                $order->delever_price = $request->delever_price;

                $pivot = json_decode($request->data);
                
                $order->save();

                $customer->update([
                    $customer->solde = $customer->solde - $request->delevery_price
                ]);

                

                foreach ( (array) $pivot as $value) {
                    # code...
                    $order->meals()->attach($value->meal_id,
                    ['quantity'=>$value->quantity]);
                }

                //partener notify when make order
                $partener = Order::where('partener_id', $request->partener_id)->first();
                if($partener)
                {
                    $SERVER_API_KEY = 'AAAAvM1BpW4:APA91bG-SW37luzuekj5h6zb2GcvPlpBxDHl1FhYHmDwAkbfu64mK58u7crnP2s1Ex-vnnvYRoRKOMyzbfd6-k7h6f5LNaUxvzcNIcmwZVolKiuQ_pLRENBVbdQmsiI4xJVjBDBHRftg';
                    $token = $partener->fcnToken;
            
                    $data = [
                        //"registration_ids" => [$token],
                        "to" => $token,
                        "notification" => [
                            "title" => "D-bla Notification",
                            "body" => "Vous avez une nouvelle commande. veillez confirmé s'il vous plaît.",
                            "sound" => "default",
                            //'click_action' => "android.intent.action.MAIN"
                        ],
                        "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                        "android" => [
                            "priority" => "high"
                        ],
                        //"time_to_live" => 14400
                    ];
            
                    $stringData = json_encode($data);
            
                    $headers = [
                        'Authorization: key ='.$SERVER_API_KEY,
                        'Content-Type: application/json',
                    ];
            
                    $ch = curl_init();
            
                    curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $stringData);
            
                    $response = curl_exec($ch);
                    curl_close($ch);
                    info($token);
                    info($response);
                } 

                //delever notify when make order
                
                foreach ($delevers as $delever) {
                    # code...
                    if($delever-> is_avalable == true)
                    {
                        $SERVER_API_KEY = 'AAAAvM1BpW4:APA91bG-SW37luzuekj5h6zb2GcvPlpBxDHl1FhYHmDwAkbfu64mK58u7crnP2s1Ex-vnnvYRoRKOMyzbfd6-k7h6f5LNaUxvzcNIcmwZVolKiuQ_pLRENBVbdQmsiI4xJVjBDBHRftg';
                        $token = $delever->fcnToken;
                
                        $data = [
                            //"registration_ids" => [$token],
                            "to" => $token,
                            "notification" => [
                                "title" => "D-bla Notification",
                                "body" => "Il y a une nouvelle commande qui à été faite. veillez consulter si vous n'êtes pas en cours de livraison.",
                                "sound" => "default",
                                //'click_action' => "android.intent.action.MAIN"
                            ],
                            "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                            "android" => [
                                "priority" => "high"
                            ],
                            //"time_to_live" => 14400
                        ];
                
                        $stringData = json_encode($data);
                
                        $headers = [
                            'Authorization: key ='.$SERVER_API_KEY,
                            'Content-Type: application/json',
                        ];
                
                        $ch = curl_init();
                
                        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringData);
                
                        $response = curl_exec($ch);
                        curl_close($ch);
                        info($token);
                        info($response);
                    }
            
                } 

                return response()->json([
                    'message' => "Order make succefull"
                ],200);
            
        }else{
            return response()->json([
                'message' => "Votre solde insufisant pour effectuer cette commande. Merci de le rechargé."
            ],403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function generateSmsCode($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
