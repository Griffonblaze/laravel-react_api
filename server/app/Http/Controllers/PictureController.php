<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\PictureValidation;

class PictureController extends Controller
{

    public function index()
    {
        $pictures = Picture::all();
        return response()->json($pictures);
    }

    public function show($id)
    {
        $picture = Picture::find($id);
        return response()->json($picture);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), PictureValidation::rules(), PictureValidation::messages());

        if ($validator->fails()) {    //Si les données ne sont pas conformes au validator, on renvoie
            return response()->json(['errors' => $validator->errors()], 401);    //une réponse correspondant aux erreurs
        }

        $fullFileName = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $file = $fileName . '_' . time() . '.' . $extension;
        $request->file('image')->storeAs('public/pictures', $file);
        $picture = Picture::create([
            'image' => $file,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => (Auth::user())->id
        ]);
        return response()->json($picture);
    }

    public function update(Request $request, $id)
    {
        $picture = Picture::find($id);
        //si jamais j'ai une image, le validator devient celui qu'on avait à la création
        if ($request->image != (Picture::find($id))->image) {
            $fullFileName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $fileName . '_' . time() . '.' . $extension;
            $request->file('image')->storeAs('public/pictures', $file);
            $picture->image = $file;
            $validator = Validator::make($request->all(),PictureValidation::rules(),PictureValidation::messages());
        } else {//si je n'ai pas d'image, le validator ne traite pas ce qu'on récupère via l'image
            $validator = Validator::make($request->all(), PictureValidation::rulesNoImage(), PictureValidation::messagesNoImage());
        }

        if ($validator->fails()) {    //Si les données ne sont pas conformes au validator, on renvoie
            return response()->json(['errors' => $validator->errors()], 401);    //une réponse correspondant aux erreurs
        }

        $picture->description = $request->input('description');
        $picture->title = $request->input('title');
        $picture->save();


        return response()->json($picture);
    }

    public function destroy($id)
    {
        $picture = Picture::find($id)->delete();
        return response()->json(['success' => 'la photo ' . $id . ' a bien été effacée']);
    }
}
