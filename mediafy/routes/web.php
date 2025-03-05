<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name("login")->middleware('guest'); //Även byt redirect om inloggad till /panel?

Route::post('login', LoginController::class)->middleware('guest');
Route::get('logout', LogoutController::class);

//Senare lägg till group för alla auth /panels
Route::get('/panel', [PanelController::class, 'index'])->middleware("auth");

Route::get('/panel/addproduct', [PanelController::class, 'addproduct'])->middleware("auth");

Route::delete('/panel/product{id}/delete', [PanelController::class, 'deleteProduct'])->name("delete");

Route::get('/panel/product/{id}/edit', [PanelController::class, 'editProduct'])->name('panel.product.edit')->middleware("auth");
Route::put('/panel/product/{id}/update', [PanelController::class, 'updateProduct'])->name('panel.product.update')->middleware("auth");

Route::post('/product', [ProductController::class, 'create']);
