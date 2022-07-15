<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PillarController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => 'v1'],function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);

    Route::group(['middleware'=> 'auth:sanctum'],function (){
        Route::post('/logout',[AuthController::class,'logout']);
        Route::resource('boards',BoardController::class)->except(['create','edit']);
        Route::resource('pillars',PillarController::class)->except(['create','edit','index']);
        Route::resource('tasks',TaskController::class)->except(['create','edit']);
        Route::get('/boards/{board}/columns',[PillarController::class,'index']);
    });


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
