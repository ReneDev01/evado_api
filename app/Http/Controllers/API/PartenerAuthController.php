<?php

namespace App\Http\Controllers\API;
use Exception;

use App\Models\Section;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PartenerAuthController extends Controller
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
            $section = new Section();
            $section->phone = $request->phone;
            $section->save();

            if(!Auth::guard('partener')->attempt($credentials)){
                return response()->json([
                    'message' => 'Invalid credantials'
                ], 403);
            }
    
            return response()->json([
                'partener' => Auth::guard('partener')->user(),
                'token' => Auth::guard('partener')->user()->createToken('secret')->plainTextToken
            ], 200);
        }
        
    }

    //logout
    public function logout(Request $request)
    {
        $partener = Auth::user();
        if($partener){
            $section = Section::where('phone', $partener->phone)->first();
            $section->delete();
        }

        return response()->json([
            'message' => 'Vous êtes decconecter!!!'
        ], 200); 
    }

    public function add_fcnToken(Request $request)
    {
        $partener = Auth::user();
        $partener->fcnToken = $request->fcnToken;
        $partener->save();
        return response($partener);
    }

    //get delever infos
    public function info()
    {
        return response(auth()->user());
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone:TG',
        ]);
        $partener = Auth::user();
        $partener->name = $request->name;
        $partener->surname = $request->surname;
        $partener->phone = $request->phone;

        $partener->save();

        return response()->json([
            "partener" => $partener
        ], 200); 
    }

    public function passForgot(Request $request)
    {
        $partener = Partener::where('phone', $request->phone)->first();

        if($partener){
            $sms_code = $this->generateSmsCode(8);
            
            $messages = "Votre nouveau mot de de passe est :".$sms_code;
            try {
                $response = Http::post('https://extranet.nghcorp.net/api/send-sms', [
                    "from"=> "D-bla",
                    "to"=> $partener->phone,
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
                $partener->update([
                    'password' => bcrypt($sms_code)
                ]);

                return response()->json([
                    "partener" => $partener
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
