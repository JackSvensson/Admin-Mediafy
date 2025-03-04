<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Platform;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Create a new product
     */
    public function create(Request $request)
    {
        // Validate the input with clear, descriptive error messages
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
