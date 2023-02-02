<?php

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Middleware\React;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\AuthenticateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthenticateController::class,'register']);
Route::post('/login', [AuthenticateController::class,'login']);

// Route::get('/pictures',function(){
//     $pictures = Picture::all();
//     return response()->json($pictures);
// });

Route::post('/pictures',[PictureController::class,'store'])->middleware(React::class);

Route::get('/pictures',[PictureController::class,'index']);

Route::get('/pictures/{id}',[PictureController::class,'show']);

Route::post('/pictures/{id}',[PictureController::class,'update']);

Route::delete('pictures/delete/{id}',[PictureController::class,'destroy']);