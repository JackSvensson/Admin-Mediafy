<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Platform;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class PanelController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->input('platform', 'ALL');

        // Base query
        $query = Title::with(['products' => function ($query) use ($platform) {
            // Only load products for the selected platform
            if ($platform != 'ALL') {
                $query->whereHas('platform', function ($q) use ($platform) {
                    $q->where('type', $platform);
                });
            }
            // Always include the platform relationship
            $query->with('platform');
        }]);

        // Only include titles that have products matching the filter
        if ($platform != 'ALL') {
            $query->whereHas('products.platform', function ($q) use ($platform) {
                $q->where('type', $platform);
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
        return redirect('/panel');
    }

    public function deleteProduct($id)
    {
        if (auth()->user()->isAdmin()) {
            $product = Product::findOrFail($id);
            $product->delete();
        }

        return redirect('/panel');
    }

    public function editProduct($id)
    {
        $product = Product::with(['title', 'platform'])->findOrFail($id);
        return view('products.edit', compact('product'));
    }

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
                $platformType = Platform::where('type', $platformType)->first();
                if ($platform) {
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
    }

    public function create(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'platforms' => 'required|array',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ], [
                'title.required' => 'You must provide a title for the product.',
                'platforms.required' => 'Please select at least one platform.',
                'price.required' => 'You must enter a price for the product.',
                'price.numeric' => 'Price must be a number.',
                'price.min' => 'Price cannot be negative.',
                'stock.required' => 'You must specify the stock quantity.',
                'stock.integer' => 'Stock quantity must be a whole number.',
                'stock.min' => 'Stock quantity cannot be negative.',
            ]);

            try {
                // Create the title first
                $title = new Title();
                $title->name = $validated['title'];
                $title->save();

                // For each platform, create a product
                foreach ($validated['platforms'] as $platformType) {
                    // Find or create the platform
                    $platform = Platform::firstOrCreate(['type' => $platformType]);

                    // Create the product
                    $product = new Product();
                    $product->title_id = $title->id;
                    $product->platform_id = $platform->id;
                    $product->price = $validated['price'];
                    $product->stock = $validated['stock'];
                    $product->save();
                }

                // Redirect with success message
                return redirect('/panel')->with('success', 'Product created successfully');
            } catch (\Exception $e) {
                // Instead of using Log::error, just return back with errors
                return back()
                    ->withInput($request->all())
                    ->withErrors(['general' => 'There was a problem creating the product. Please try again.']);
            }
        }
    }
}
