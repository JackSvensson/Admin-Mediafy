<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-8 text-neutral-1">
    
    <main class="flex flex-row">
        <!-- Sidebar navigation -->
        <nav aria-label="Main Navigation" id="sidebar" class="flex flex-col p-4 w-[250px]">
            <div class="flex items-center space-x-2 mb-4">
                <h1 class="text-xl font-semibold">Admin Panel</h1>
            </div>
            <ul role="menu">
                <li role="menuitem"><a href="/panel" class="text-neutral-1 hover:underline">Products</a></li>
                <li role="menuitem"><a href="/" class="text-neutral-1 hover:underline">Users</a></li>
                <li role="menuitem"><a href="/logout" class="text-neutral-1 hover:underline">Logout</a></li>
            </ul>
        </nav>
        
        <!-- Main content -->
        <section aria-label="Content" id="maincontent" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4 pb-6 items-center">
                <h1 class="text-xl font-semibold">Edit product</h1>
            </header>
            
            <!-- Edit form -->
            <div id="editProductForm" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
                <form method="POST" action="/panel/product/{{ $product->id }}/update" aria-label="Edit product form" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <!-- Display validation errors if present -->
                    @if ($errors->any())
                        <div role="alert" class="bg-red-900 text-white p-4 mb-4 rounded">
                            <h2 class="text-lg font-bold mb-2">Please fix the following errors:</h2>
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
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
                        <label for="stock" class="block mb-2 font-medium">Antal i lager</label>
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
        </section>
    </main>
</body>
</html>