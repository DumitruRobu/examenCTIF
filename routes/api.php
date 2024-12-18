<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/selectInfo', ['App\Http\Controllers\MainController', 'returnEcoRaionLocalitate']);
Route::get('/updateLocalities/{raion_code}', ['App\Http\Controllers\MainController', 'updateLocalitati']);
Route::post('/extractIban', ['App\Http\Controllers\MainController', 'extractIban']);
