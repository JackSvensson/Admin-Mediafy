<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Title;

class ProductController extends Controller
{

    // In App\Http\Controllers\ProductController.php


    public function create(Request $request)
    {
        $title = new Title();
        $title->name = $request->get('title');
        $title->save();
        return redirect('/');
    }
}
