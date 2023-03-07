<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function start()
    {
        $SERVER_API_KEY = 'AAAAvM1BpW4:APA91bG-SW37luzuekj5h6zb2GcvPlpBxDHl1FhYHmDwAkbfu64mK58u7crnP2s1Ex-vnnvYRoRKOMyzbfd6-k7h6f5LNaUxvzcNIcmwZVolKiuQ_pLRENBVbdQmsiI4xJVjBDBHRftg';
        $token = Auth::user()->fcnToken;

        $data = [
            //"registration_ids" => [$token],
            "to" => $token,
            "notification" => [
                "title" => "D-bla Notification",
                "body" => "Merci de nous avoir fait confiance pour votre commande. Votre serez livrer dans les minutes qui suivent.",
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

        return response($response);
        
        //dd($response);
    }

    public function promoNotify()
    {
        $SERVER_API_KEY = 'AAAAvM1BpW4:APA91bG-SW37luzuekj5h6zb2GcvPlpBxDHl1FhYHmDwAkbfu64mK58u7crnP2s1Ex-vnnvYRoRKOMyzbfd6-k7h6f5LNaUxvzcNIcmwZVolKiuQ_pLRENBVbdQmsiI4xJVjBDBHRftg';
        $token = Auth::user()->fcnToken;

        $data = [
            "registration_ids" => [$token],
            //"to" => $token,
            "notification" => [
                "title" => "D-bla Notification",
                "body" => "Profitez de nos promotionn de 25 et 28 pourcent chaque Mardi et vendredi.",
                "sound" => "default",
                
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
        return response($response);
    }
}
