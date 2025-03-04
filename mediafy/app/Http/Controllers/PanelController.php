<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Product;


class PanelController extends Controller
{
    public function index()
    {
        // Get all titles with their related platforms
        $titles = Title::with(['products.platform'])->get();

        return view('panel', compact('titles'));
    }

    public function addProduct()
    {
        return view('add');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/panel');
    }
}
