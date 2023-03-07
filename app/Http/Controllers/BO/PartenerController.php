<?php

namespace App\Http\Controllers\BO;
use Exception;

use App\Models\Type;
use App\Models\Partener;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class PartenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parteners = Partener::with('type')->get();
        return view('pages.parteners.index', compact('parteners')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if(Gate::denies('create-partener'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $types = Type::all();
        return view('pages.parteners.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|phone:TG',
            'logo' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'type_id' => 'required',
        ]);
        $sms_code = $this->generateSmsCode(6);
        $partener = new Partener();
        $partener->name = $request->name;
        $partener->phone = $request->phone;
        $partener->start_hours = $request->start_hours;
        $partener->end_hours = $request->end_hours;
        $partener->solde = 0;
        $partener->longitude = $request->longitude;
        $partener->latitude = $request->latitude;
        $partener->type_id = $request->type_id;
        $partener->neighboord = $request->neighboord;
        $partener->password = bcrypt($sms_code);
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/parteners');
            $image->move($destinationPath, $img_name);
            $partener->logo = 'images/parteners/'.$img_name;
        }

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
            $partener->save();

            Toastr()->success('Partenaire créer avec succès!', 'Create Partener');
            return redirect('/parteners');
        }else{
            Toastr()->success('réessayé!', 'Create Partener');
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
        $partener = Partener::find($id);
        return view('pages.parteners.show', compact('partener'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('edit-partener'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $types = type::all();
        $partener = Partener::find($id);

        return view('pages.parteners.edit', compact('partener', 'types'));
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
            'name' => 'required',
            'phone' => 'phone:TG',
            'longitude' => 'required',
            'start_hours'=>'required',
            'end_hours'=>'required',
            'latitude' => 'required',
            'type_id' => 'required',
        ]);
        $partener = Partener::find($id);
        $partener->name = $request->name;
        $partener->start_hours = $request->start_hours;
        $partener->end_hours = $request->end_hours;
        $partener->phone = $request->phone;
        $partener->solde = $partener->solde;
        $partener->longitude = $request->longitude;
        $partener->latitude = $request->latitude;
        $partener->type_id = $request->type_id;
        $partener->neighboord = $request->neighboord;
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/parteners');
            $image->move($destinationPath, $img_name);
            $partener->logo = 'images/parteners/'.$img_name;
        }
        //dd($partener);
        $partener->save();

        Toastr()->success('Partenaire mise à jour avec succès!', 'Update partener');
        return redirect('/parteners'); 
    }

    public function activeOrDesactive($id)
    {
        $getActive = Partener::select('active')->where('id',$id)->first(); 
        if($getActive->active == 0)
        {
            $active = 1;
            Partener::where('id',$id)->update(['active' => $active]);

            Toastr()->success('Partenaire activé avec succès!', 'Active partener');
        return redirect()->back();
        }else{
            $active = 0;
            Partener::where('id',$id)->update(['active' => $active]);

            Toastr()->success('Partenaire Désactivé avec succès!', 'Active partener');
            return redirect()->back();
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partener $partener, $id)
    {
        if(Gate::denies('delete-partener'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $partener = Partener::find($id);
        $partener->delete();

        Toastr()->success('Partenaire supprimé avec succès!', 'Delete partener');
        return redirect('/parteners');
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
