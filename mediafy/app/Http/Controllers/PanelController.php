<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Product;
use App\Models\Platform;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PanelController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->input('platform', 'ALL');


        $query = Title::with(['products.platform']);

        if ($platform == 'ALL') {

            $query->whereHas('products.platform', function ($query) {
                $query->whereIn('type', ['Xbox', 'Playstation', 'Nintendo']);
            });
        } else {

            $query->whereHas('products.platform', function ($query) use ($platform) {
                $query->where('type', $platform);
            });
        }


        $titles = $query->paginate(3);


        return view('products.panel', compact('titles', 'platform'));
    }

    public function addProduct()
    {
        if (auth()->user()->isAdmin()) {
            return view('products.add');
        }
    }

    public function deleteProduct($id)
    {
        if (auth()->user()->isAdmin()) {
            $product = Product::findOrFail($id);
            $product->delete();
        }

        return redirect('/panel');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function editProduct($id)
    {
        $product = Product::with(['title', 'platform'])->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function updateProduct(Request $request, $id)
    {
        if (auth()->user()->isAdmin()) {
            // Add debugging to see what's happening
            Log::info('Update Product Request', [
                'id' => $id,
                'request' => $request->all()
            ]);

            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'platforms' => 'required|array',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ]);

            // Find the product
            $product = Product::with('title')->findOrFail($id);

            // Update the title name
            $product->title->name = $request->input('title');
            $product->title->save();

            // Update platform if it has changed
            if (!empty($request->input('platforms'))) {
                $platformType = $request->input('platforms')[0]; // Get the first selected platform
                $platform = Platform::where('type', $platformType)->first();
                if (!$platform) {
                    $platform = Platform::create(['type' => $platformType]);
                }
                $product->platform_id = $platform->id;
            }
        }

        // Update price and stock
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // Save the product changes
        $saved = $product->save();

        Log::info('Product Update Result', [
            'saved' => $saved,
            'product_after_save' => $product->toArray()
        ]);
        return redirect('/panel');
    }

    // Explicitly redirect back to the panel


}
