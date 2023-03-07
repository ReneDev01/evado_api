<?php

namespace App\Http\Controllers\API;
use Exception;
use App\Models\Delever;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DeleverAuthController extends Controller
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

            if(!Auth::guard('delever')->attempt($credentials)){
                return response()->json([
                    'message' => 'Invalid credantials'
                ], 403);
            }else{
                $section = new Section();
                $section->phone = $request->phone;
                $section->save();

                Auth::guard('delever')->user()->update([
                    "is_avalable" => true
                ]);
                
                return response()->json([
                    'delever' => Auth::guard('delever')->user(),
                    'token' => Auth::guard('delever')->user()->createToken('secret')->plainTextToken
                ], 200);
            }

        }

        
    }

    //logout
    public function logout(Request $request)
    {
        $delever = Auth::user();
        $delever->is_avalable = false;
        $delever->save();

        if($delever){
            $section = Section::where('phone', $delever->phone)->first();
            $section->delete();
        }

        return response()->json([
            'message' => 'Vous êtes déconnecter!!!'
        ], 200); 
    }

    //get delever infos
    public function info()
    {
        return response(auth()->user());
    }

    public function add_fcnToken(Request $request)
    {
        $delever = Auth::user();
        $delever->fcnToken = $request->fcnToken;
        $delever->save();
        return response($delever);
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone:TG',
        ]);
        $delever = Auth::user();
        $delever->name = $request->name;
        $delever->surname = $request->surname;
        $delever->phone = $request->phone;

        $delever->save();

        return response()->json([
            "delever" => $delever
        ], 200); 
    }

    public function passForgot(Request $request)
    {
        $delever = Delever::where('phone', $request->phone)->first();

        if($delever){
            $sms_code = $this->generateSmsCode(6);
            
            $messages = "Votre nouveau mot de de passe est :".$sms_code;
            try {
                $response = Http::post('https://extranet.nghcorp.net/api/send-sms', [
                    "from"=> "D-bla",
                    "to"=> $delever->phone,
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
                $delever->update([
                    'password' => bcrypt($sms_code)
                ]);

                return response()->json([
                    "delever" => $delever
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
