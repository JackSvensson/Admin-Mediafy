<?php

use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/panel', [PanelController::class, 'index']);
Route::get('/panel/addproduct', [PanelController::class, 'addproduct']);



//Posts
Route::post('/product', [ProductController::class, 'create']);
