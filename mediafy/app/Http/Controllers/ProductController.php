<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Platform;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show form to create a new product
     */
    public function create(Request $request)
    {
        $title = new Title();
        $title->name = $request->get('title');
        $title->save();

        // Get platforms from request
        $platformTypes = $request->input('platforms', []);

        foreach ($platformTypes as $platformType) {
            // Find or create the platform
            $platform = Platform::firstOrCreate([
                'type' => $platformType
            ]);

            // Create the product with price and stock info
            $product = new Product();
            $product->title_id = $title->id;
            $product->platform_id = $platform->id;
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->save();
        }

        return redirect('/panel');
    }
}
