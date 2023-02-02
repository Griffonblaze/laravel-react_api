<?php

namespace App\Http\Validation;

class LoginValidation{

    public static function rules(){
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    public static function messages()
    {
        return 
        [
            'email.required' => "l'adresse mail est nécessaire",
            'password.required' => "le mot de passe est requis",
        ];
    }


}

?>