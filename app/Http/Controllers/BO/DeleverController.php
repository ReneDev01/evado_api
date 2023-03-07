<?php

namespace App\Http\Controllers\BO;
use Exception;
use App\Models\Delever;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class DeleverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $delevers = Delever::all();

        return view('pages/delevers/index', compact('delevers'));
    }

    public function operate($id)
    {
        $delever = Delever::with('operations')
        ->where('id', $id)
        ->first();

        return view('pages/delevers/operation', compact('delever'));
    }

    public function valide($id)
    {
        $getActive = Operation::where('id',$id)->first(); 
        if($getActive)
        {
            Operation::where('id',$id)->update(['status' => true]);

            Toastr()->success('Retrait valider avec succès!', 'Valider un retrait');
            return redirect()->back();
        }
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-deliver'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        return view('pages/delevers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        //
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required:TG',
            //'card_id' => 'required',
            'birthday' => 'required',
            'sex' => 'required',
            //'status' => 'required',
        ]);

        
        $delever = new Delever();
        $sms_code = $this->generateSmsCode(8);

        $delever->name = $request->name;
        $delever->surname = $request->surname;
        $delever->phone = $request->phone;
        $delever->card_id = "id cart";
        $delever->solde = "0";
        $delever->birthday = $request->birthday;
        $delever->sex = $request->sex;
        $delever->password = bcrypt($sms_code);
        
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
            Toastr()->success('Réessayé!', "Erreur d'envoie d'sms");
            return redirect()->back();
        }

        $message = $response->status();

        if($message == 200)
        {
            $delever->save();

            Toastr()->success('Livreur créer avec succès!', 'Create Delever');
            return redirect('/delevers');
        }else{
            Toastr()->success('réessayé!', 'Create Delever');
            return redirect()->back();
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
        if(Gate::denies('show-deliver'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        //
        $delever = Delever::find($id);

        return response()->json([
            "delever"=>$delever
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $delever = Delever::find($id);

        return response() -> json([
            "delever" => $delever
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
        $sms_code = $this->generateSmsCode(6);
        $request -> validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'password' => 'required',
            //'card_id' => 'required',
            'solde' => 'required',
            'birthday' => 'required',
            'sex' => 'required',
            //'status' => 'required',
        ]);

        $delever = Delever::find($id);

        $delever -> update([
            "name" => $request->name,
            "surname" => $request->surname,
            "phone" => $request->phone,
            "password" => $request->password,
            "card_id" => $request->card_id,
            "solde" => $request->solde,
            "birthday" => $request->birthday,
            "sex" => $request->sex,
            "password" => bcrypt($sms_code)
            //"status" => $request -> status,
        ]);

        try {
  
            $basic  = new \Vonage\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Vonage\Client($basic);

            $message = "Votre code de confirmation et votre mots de de passe est :";
  
            $message = $client->message()->send([
                'to' => $request->phone,
                'from' => 'TEGI-DEBLA',
                'text' => $message
            ]);
  
            dd('SMS Sent Successfully.');
              
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }

        return response()->json([
            "delever" => $delever,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delever $delever)
    {
        if(Gate::denies('delete-deliver'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $delever->delete();
        Toastr()->success('Livreur supprimer avec succès!', 'Delete Delever');
        return redirect('/delevers');
    }

    // block delever

    public function block($id)
    {
        if(Gate::denies('block-deliver'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $getStatus = Delever::select('status')->where('id',$id)->first(); 
        if($getStatus->status == 0)
        {
            $status = 1;
        }else{
            $status = 0;
        }

        Delever::where('id',$id)->update(['status' => $status]);

        Toastr()->success('Livreur Bloquer avec succès!', 'Block Delever');
        return redirect('/delevers');
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
