<?php

namespace App\Http\Validation;

    class RegisterValidation{

        public static function rules(){
            return [
                'email' => 'required|string|email|min:5|max:150|unique:users',
                'name' => 'required|string|min:5|max:150',
                'password' => 'required|min:8|string',
                'confirm_password' => 'required|same:password'];
        }

        public static function messages()
        {
            return 
            [
                'email.required' => "l'adresse mail est nécessaire",
                'email.unique' => "l'adresse mail est déjà utilisée, veuillez en mettre une autre",
                'name.required' => 'le nom est nécessaire',
                'password.min' => "le mot de passe doit contenir au minimum 8 caractères",
                'confirm_password.same' => 'la confirmation doit être le même mot de passe que le mot de passe désigné'
            ];
        }


    }



?>