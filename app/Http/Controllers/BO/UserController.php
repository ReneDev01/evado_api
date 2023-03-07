<?php

namespace App\Http\Controllers\BO;
use Exception;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function index()
    {
        if(Gate::denies('all-user'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }

        $users= User::all();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        if(Gate::denies('create-user'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $sms_code = $this->generateSmsCode(8);

        $request->validate([
            "name"=>"required",
            "surname"=>"required",
            "phone"=>"required|phone:TG",
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone = $request->phone;
        $user->sexe = $request->sexe;
        $user->password = bcrypt($sms_code);
        $roles = $request->roles;

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
            $user->save();
            $user->roles()->attach($roles);
            Toastr()->success('Utilisateur enrégistré avec succès!', 'Save User');
            return view('pages.users.index');
        }else{
            Toastr()->success('Réessayé!', 'Create User');
            return redirect()->back();
        }

    }

    public function show($id)
    {
        if(Gate::denies('show-user'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $user = User::with('roles')->where('id', $id)->first();
        return view('pages.users.show', compact('user'));
    }


    public function edit($id)
    {
        if(Gate::denies('edit-user'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }
        $roles = Role::all();
        $user = User::with('roles')->where('id', $id)->first();
        return view('pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>"required",
            "surname"=>"required",
            "phone"=>"required|phone:TG",
        ]);

        $user= User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone = $request->phone;
        $roles = $roles = $request->roles;

        $user->save();

        $user->roles()->attach($roles);

        Toastr()->success('Mise à jour éffectuer avec succès!', 'Update User');
        return redirect('/user/index');
    }

    public function destroy(User $user)
    {    
        if(Gate::denies('delete-user'))
        {
            Toastr()->error("Vous n'avez pas l'habilité à aller sur cette page.");
            return redirect('/dashboard');
        }   
        $user-> delete();

        Toastr()->success('Suppression éffectuer avec succès!', 'Delete User');
        return view('pages.users.index');
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
