<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Mail\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $getUser = User::where('id_role', '=', 2)->paginate(9);
        return $getUser;
    }

    public function addUpdate(Request $request)
    {
        /*
         * Validation des inputs
         */
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'id' => ''
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
            ]
        )->validate();

        Mail::to($validator['email'])->send(new Contact([
            'name' => $validator['name'],
            'email' => 'admin@gmail.com',
        ]));

        $user = '';

        if(isset($validator['id'])) {
            $user = User::find($validator['id']);
        }
        if (!$user) {
            $donneesBdd = new User;
            $donneesBdd->password = bcrypt("password");
            $donneesBdd->id_role = 2;
        } else {
            $donneesBdd = $user;
        }

        $donneesBdd->name = $validator['name'];
        $donneesBdd->email = $validator['email'];
        
        $donneesBdd->save();

        return new UsersResource($donneesBdd);
    }


    public function deleteUser(Request $request, $id)
    {
        $getUsers = User::where('id', '=', $id)->first()->delete();
        if ($getUsers) {
            return "ok l'utilisateur a été supprimé";
        } else {
            return 'erreur';
        }
    }
}
