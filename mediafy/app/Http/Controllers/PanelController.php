<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Product;


class PanelController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->input('platform', 'All');

        if ($platform == 'All') {
            // Hämtar alla platform
            $titles = Title::with(['products.platform'])
                ->whereHas('products.platform', function ($query) {
                    $query->whereIn('type', ['Xbox', 'Playstation', 'Nintendo']); //Kanske går lösa annat vis
                })
                ->paginate(3);
        } else {

            $titles = Title::with(['products.platform'])
                ->whereHas('products.platform', function ($query) use ($platform) {
                    $query->where('type', $platform);
                })->paginate(3);
        }

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
