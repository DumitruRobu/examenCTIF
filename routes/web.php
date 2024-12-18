<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/{page}', ['App\Http\Controllers\MainController', 'index'])->where('page', '.*');
