<?php

namespace App\Http\Controllers\API;
use Exception;
use GuzzleHttp\Client;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return response()->json([
            "customers" => $customers
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'phone' => 'required|phone:TG',
        ]);


        $sms_code = $this->generateSmsCode(8);
        $customer = new Customer();
        $customer->phone = $request->phone;
        $customer->password = bcrypt($sms_code);
        $customer->status = true;
        $customer->solde = 0;

        $messages = "Votre code de confirmation et votre mots de de passe est :".$sms_code;

        try {
            $response = Http::post('https://extranet.nghcorp.net/api/send-sms', [
                "from"=> "D-bla",
                "to"=> $request->phone,
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
            $customer->save();
            echo $sms_code;
            return response()->json([
                "customer" => $customer
            ], 200); 
        }else{
            return response("Réessayé s'il vous plaît");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return response()->json([
            "customer" => $customer
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return response()->json([
            "customer" => $customer
        ], 200);
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
    

    //block customer

    public function block($id)
    {
        $customer = Customer::find($id);

        $customer->update([
            "status" => false
        ]);

        return response()->json([
            "customer" => $customer
        ], 200);
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

    /* $voucher->code = $this->generateRandomString(6);// it should be dynamic and unique  */
}
