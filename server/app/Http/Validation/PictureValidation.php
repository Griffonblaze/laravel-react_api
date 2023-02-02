<?php

namespace App\Http\Validation;

class PictureValidation{

    public static function rules(){
        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:10',
            'image' => 'required|mimes:jpg,png,pdf|image'
        ];
    }

    public static function rulesNoImage(){
        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:10'
        ];
    }



    public static function messages()
    {
        return 
        [
            'title.required' => "le titre est nécessaire. ",
            'title.min' => "Le titre doit être de minimum 5 caractères. ",
            'description.min' => "La description doit être de minimum 10 caractères. ",
            'description.required' => "la description est nécessaire. ",
            'image.required' => "l'image est requise. ",
            'image.mimes' => "l'image ne peut être qu'aux formats suivant : jpg,png,pdf. ",
            'image.image' => "le fichier transmis n'est pas une image. "
        ];
    }


    public static function messagesNoImage()
    {
        return 
        [
            'title.required' => "le titre est nécessaire. ",
            'title.min' => "Le titre doit être de minimum 5 caractères. ",
            'description.min' => "La description doit être de minimum 10 caractères. ",
            'description.required' => "la description est nécessaire. "
        ];
    }


}

?>