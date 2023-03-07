<?php

namespace App\Http\Controllers\API;
use Exception;
use App\Models\Section;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|phone:TG',
            'password' => 'required',
        ]);

        $section = Section::where('phone', $request->phone)->first();
        if($section){
            return response()->json([
                'message' => "L'Utilisateur est déjà connectée!!"
            ], 403);
        }else{
            
            if(!Auth::guard('customer')->attempt($credentials)){
                return response()->json([
                    'message' => 'Invalid credantials'
                ], 403);
            }else{
                $section = new Section();
                $section->phone = $request->phone;
                $section->save();
        
                return response()->json([
                    'customer' => Auth::guard('customer')->user(),
                    'token' => Auth::guard('customer')->user()->createToken('secret')->plainTextToken
                ], 200);
            }

            
        }

        

    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone:TG',
        ]);
        $customer = Auth::user();
        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $customer->phone = $request->phone;

        $customer->save();

        return response()->json([
            "customer" => $customer
        ], 200); 
    }

    //logout
    public function logout()
    {
        $customer = Auth::user();

        if($customer){
            
            $section = Section::where('phone', $customer->phone)->first();
            $section->delete();

            return response()->json([
                "message" => "Vous êtes bien deconnecter!!!"
            ], 200);
        }

        /* w */
    }

    public function add_fcnToken(Request $request)
    {
        $customer = Auth::user();
        $customer->fcnToken = $request->fcnToken;
        $customer->save();
        return response($customer);
    }

    //get Customer infos
    public function info()
    {
        return response(auth()->user());
    }

    public function completeInfo(Request $request)
    {
        $customer = Auth::user();
        //dd($customer);
        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $datetime=strtotime($request->birthday);
        $format = date('Y-m-d H:i', $datetime);
        $customer->birthday = $format;
        $customer->save();
        
        return response()->json([
            'customer' => $customer
        ], 200);
    }

    public function smsValidate(Request $request)
    {
        //$customer = Customer::where(Hash::check('password', $request->password))->first();
        $customers = Customer::all();
        foreach ($customers as $customer) {
            # code...
            if(Hash::check($request->password, $customer->password)){
                $customer->update([
                    "isActive" => true
                ]);

                $section = new Section();
                $section->phone = $customer->phone;
                $section->save();

                return response()->json([
                    'customer' => $customer,
                    'token' => $customer->createToken('secret')->plainTextToken
                ], 200);
            }else{
                return "Vote code incorrecte. Réssayer";
            }
        }
        
    }

    public function passForgot(Request $request)
    {
        $customer = Customer::where('phone', $request->phone)->first();
        if($customer){
            $sms_code = $this->generateSmsCode(8);
            $messages = "Votre nouveau mot de de passe est :".$sms_code;
            try {
                $response = Http::post('https://extranet.nghcorp.net/api/send-sms', [
                    "from"=> "D-bla",
                    "to"=> $customer->phone,
                    "text"=> $messages,
                    "api_key"=> "k_DUdzzFeqlqaak1AC8NtHC7ZtolURWwhj",
                    "api_secret"=> "s_CLu2kwZuba4VMkuSTtAXZ1JepAaAwpzq"
                ]);
            } catch (Exception $e) {
                info("Error: ". $e->getMessage());
            }
            if($response){
                $message = $response->status();
            }else{
                return response()->json([
                    "message" => "Réessayé, Erreur d'envoi d'sms"
                ], 200);
            }
    
            $message = $response->status();
    
            if($message == 200)
            {
                $customer->update([
                    'password' => bcrypt($sms_code)
                ]);

                return response()->json([
                    "customer" => $customer
                ], 200); 
            }else{
                return response("Réessayé s'il vous plaît");
            }
        }
    }

    private function generateSmsCode($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    
}
