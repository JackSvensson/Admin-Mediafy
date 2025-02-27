<?php

use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'home');

Route::get('/panel', PanelController::class);



Route::post('/product', ProductController::class, 'create');
