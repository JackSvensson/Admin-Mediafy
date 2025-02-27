<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    // In App\Http\Controllers\ProductController.php
    public function __invoke(Request $request)
    {
        return redirect('/');
    }

    public function create(Request $request)
    {


        return redirect('/');
    }
}
