<x-admin-layout title="Edit Product - Admin Panel" contentLabel="Edit Product Form" headerTitle="Edit product">
    <div id="editProductForm" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
        <form method="POST" action="/panel/product/{{ $product->id }}/update" aria-label="Edit product form" novalidate>
            @csrf
            @method('PUT')
            
            <!-- Title field -->
            <div class="mb-4">
                <label for="title" class="block mb-2 font-medium">Title</label>
                <input 
                    name="title" 
                    id="title" 
                    type="text" 
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('title') input-error @enderror" 
                    value="{{ old('title', $product->title->name) }}" 
                    required 
                    aria-required="true"
                    aria-describedby="title-error"
                />
                @error('title')
                    <p id="title-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Platforms field -->
            <fieldset class="mb-4">
                <legend class="block mb-2 font-medium">Platforms</legend>
                <div class="flex flex-wrap gap-4" role="group" aria-labelledby="platforms-group">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="platform-playstation" 
                            name="platforms[]" 
                            value="Playstation" 
                            class="mr-2 bg-neutral-8 border-neutral-7 h-5 w-5"
                            {{ (old('platforms') && in_array('Playstation', old('platforms'))) || $product->platform->type == 'Playstation' ? 'checked' : '' }}
                        >
                        <label for="platform-playstation">Playstation</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="platform-xbox" 
                            name="platforms[]" 
                            value="Xbox" 
                            class="mr-2 bg-neutral-8 border-neutral-7 h-5 w-5"
                            {{ (old('platforms') && in_array('Xbox', old('platforms'))) || $product->platform->type == 'Xbox' ? 'checked' : '' }}
                        >
                        <label for="platform-xbox">Xbox</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="platform-nintendo" 
                            name="platforms[]" 
                            value="Nintendo" 
                            class="mr-2 bg-neutral-8 border-neutral-7 h-5 w-5"
                            {{ (old('platforms') && in_array('Nintendo', old('platforms'))) || $product->platform->type == 'Nintendo' ? 'checked' : '' }}
                        >
                        <label for="platform-nintendo">Nintendo Switch</label>
                    </div>
                </div>
                @error('platforms')
                    <p id="platforms-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </fieldset>
            
            <!-- Price field -->
            <div class="mb-4">
                <label for="price" class="block mb-2 font-medium">Price (kr)</label>
                <input 
                    name="price" 
                    id="price" 
                    type="number" 
                    min="0" 
                    step="1"
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('price') input-error @enderror" 
                    value="{{ old('price', $product->price) }}" 
                    required 
                    aria-required="true"
                    aria-describedby="price-error"
                />
                @error('price')
                    <p id="price-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Stock field -->
            <div class="mb-4">
                <label for="stock" class="block mb-2 font-medium">Quantity in stock</label>
                <input 
                    name="stock" 
                    id="stock" 
                    type="number"
                    min="0"
                    step="1"
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('stock') input-error @enderror" 
                    value="{{ old('stock', $product->stock) }}" 
                    required 
                    aria-required="true"
                    aria-describedby="stock-error"
                />
                @error('stock')
                    <p id="stock-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit button -->
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-primary-1 px-6 py-2 inline-block rounded-md font-medium"
                    aria-label="Save product changes"
                >
                    Save
                </button>
                <a 
                    href="/panel" 
                    class="bg-neutral-7 text-neutral-1 px-6 py-2 inline-block rounded-md font-medium"
                    aria-label="Cancel and return to product list"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>