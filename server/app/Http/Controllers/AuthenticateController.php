<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Validation\LoginValidation;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\RegisterValidation;

class AuthenticateController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),RegisterValidation::rules(),RegisterValidation::messages());

        if($validator->fails()){    //Si les données ne sont pas conformes au validator, on renvoie
            return response()->json(['errors' => $validator->errors()],401);    //une réponse correspondant aux erreurs
        }
        
        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'api_token' => Str::random(60)
        ]);

        return response()->json($user);

    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),LoginValidation::rules(),LoginValidation::messages());

        if($validator->fails()){    //Si les données ne sont pas conformes au validator, on renvoie
            return response()->json(['errors' => $validator->errors()],401);    //une réponse correspondant aux erreurs
        }
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])){
            $user = User::where("email", $request->input('email'))->firstOrFail();
            return response()->json($user);
        }else{
            return response()->json(['errors' => 'Mauvais identifiants de connexion'],401);
        };
    }
}
