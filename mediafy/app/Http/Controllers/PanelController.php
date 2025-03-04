<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Product;
use App\Models\Platform;
use Illuminate\Support\Facades\Log;

class PanelController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->input('platform', 'ALL');

        if ($platform == 'ALL') {
            // Hämtar alla platform
            $titles = Title::with(['products.platform'])
                ->whereHas('products.platform', function ($query) {
                    $query->whereIn('type', ['Xbox', 'Playstation', 'Nintendo']);
                })
                ->paginate(3);
        } else {
            $titles = Title::with(['products.platform'])
                ->whereHas('products.platform', function ($query) use ($platform) {
                    $query->where('type', $platform);
                })
                ->paginate(3);
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

    /**
     * Show the form for editing the specified product.
     */
    public function editProduct($id)
    {
        $product = Product::with(['title', 'platform'])->findOrFail($id);
        return view('edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function updateProduct(Request $request, $id)
    {
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
            $platform = Platform::firstOrCreate(['type' => $platformType]);
            $product->platform_id = $platform->id;
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

        // Explicitly redirect back to the panel
        return redirect('/panel');
    }
}
