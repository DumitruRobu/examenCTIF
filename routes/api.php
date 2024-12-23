<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/register', [App\Http\Controllers\MainController::class, 'register']);

Route::group([ 'middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);

    Route::group(['middleware'=>'jwt.auth'],function(){
        Route::get('/getUser', [\App\Http\Controllers\MainController::class, 'getUser']);

        Route::get('/selectInfo', ['App\Http\Controllers\MainController', 'returnEcoRaionLocalitate']);
        Route::get('/updateLocalities/{raion_code}', ['App\Http\Controllers\MainController', 'updateLocalitati']);
        Route::post('/extractIban', ['App\Http\Controllers\MainController', 'extractIban']);

        Route::get('/getAllUsers', ['App\Http\Controllers\MainController', 'getAllUsers']);
        Route::delete('/deleteUser/{id}',['App\Http\Controllers\MainController', 'deleteUser']);
    });
});
