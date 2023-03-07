<?php

namespace App\Http\Controllers\API;

use Exception;

use App\Models\Delever;
use App\Models\Customer;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OperationsController extends Controller
{

    public function delever_paiement_get()
    {
        $operations = Operation::where('delever_id', Auth::user()->id)
        ->OrderBy('id', 'DESC')
        ->get();

        return response($operations);
    }
    
    public function get_customer_credit()
    {
        $operations = Operation::where('customer_id', Auth::user()->id)
        ->where('status', true)
        ->OrderBy('id', 'DESC')
        ->get();

        return response($operations);
    }

    public function delever_paiement(Request $request)
    {
        $request->validate([
            'price' => 'required',
        ]);

        $delever = Delever::where('id', Auth::user()->id)->first();

        if($delever->solde > $request->price )
        {
            $operation = new Operation();
            $operation->price = $request->price;
            $operation->type = 'retrait';
            $operation->delever_id = Auth::user()->id;

            $operation->save();

            $delever->Update([
                'solde' => $delever->solde - $request->price
            ]);

            return response()->json([
                "operation" => $operation
            ], 200); 
        }else{
            return response()->json([
                'message' => "Votre montant actuele n'est pas suffisant."
            ],201);
        }
    }

    public function creditAccount(Request $request)
    {
        $customer = Auth::user();

        $request->validate([
            'phone_number' => 'required',
            'amount' => 'required',
            'network' => 'required',
        ]);

        if($customer)
        {
            $my_id = $this->generateCreditAccount(8);
            try {
                $response = Http::post('https://paygateglobal.com/api/v1/pay', [
                    'auth_token' => "d2bbed7a-096a-441e-8994-b8379501c7c2",
                    'phone_number' => $request->phone_number,
                    'amount' => $request->amount,
                    'network' => $request->network,
                    'identifier' => $my_id,
                    'description' => "Dépôt d'argent"
                ]);
                $responses = json_decode($response);
                
                if($responses->status == 0)
                { 
                    $operation = new Operation();
                    $operation->price = $request->amount;
                    $operation->type = 'depôt';
                    $operation->customer_id = Auth::user()->id;
                    $operation->identifier = $my_id;
                    $operation->save();

                    return response()->json([
                        'message' => 'Confirmer votre dépôt. Merci !!!!!'
                    ], 200);

                }elseif($responses->status == 4)
                {
                    return response()->json([
                        'message' => 'Parametre(s) invalide(s)'
                    ], 201);
                }elseif($responses->status == 2){
                    return response()->json([
                        'message' => 'Erreur de Jeton'
                    ], 201);
                }else{
                    return response()->json([
                        'message' => 'La transaction existe déjà'
                    ], 201);
                }
            } catch (Exception $e) {
                return $e;
            }
        }
    }

    public function confirm_paygate(Request $request)
    {
        $operation = Operation::where('identifier', $request->identifier)->first();
        $customer = Customer::where('id', $operation->customer_id)->first();
        $operation->status = true;
        $operation->payment_reference = $request->payment_reference;
        $operation->save();

        $customer->update([
            'solde' => $customer->solde + $operation->price
        ]);

        return response()->json([
            'message' => 'Votre dépot à été confirmer avec succes'
        ], 200);
    }

    private function generateCreditAccount($length = 20)
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
