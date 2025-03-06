<x-admin-layout title="Add Product - Mediafy Admin" contentLabel="Add Product Form" headerTitle="Add new product">
    <div id="addProductForm" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
        <form method="POST" action="/product" aria-labelledby="formHeading" novalidate>
            @csrf
            <h3 id="formHeading" class="sr-only">Product details form</h3>
            
            <div class="mb-4">
                <label for="title" class="block mb-2 font-medium">Title</label>
                <input 
                    name="title" 
                    id="title" 
                    type="text" 
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('title') input-error @enderror" 
                    value="{{ old('title') }}" 
                    required 
                    aria-required="true"
                >
                @error('title')
                    <p id="title-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <fieldset class="mb-4">
                <legend class="block mb-2 font-medium">Platforms</legend>
                <div class="flex flex-wrap gap-4" role="group" aria-label="Available platforms">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="platform-playstation" 
                            name="platforms[]" 
                            value="Playstation" 
                            class="mr-2 bg-neutral-8 border-neutral-7 h-5 w-5"
                            {{ (old('platforms') && in_array('Playstation', old('platforms'))) ? 'checked' : '' }}
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
                            {{ (old('platforms') && in_array('Xbox', old('platforms'))) ? 'checked' : '' }}
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
                            {{ (old('platforms') && in_array('Nintendo', old('platforms'))) ? 'checked' : '' }}
                        >
                        <label for="platform-nintendo">Nintendo Switch</label>
                    </div>
                </div>
                @error('platforms')
                    <p id="platforms-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </fieldset>
            
            <div class="mb-4">
                <label for="price" class="block mb-2 font-medium">Price (kr)</label>
                <input 
                    name="price" 
                    id="price" 
                    type="number" 
                    min="0"
                    step="1"
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('price') input-error @enderror" 
                    value="{{ old('price') }}" 
                    required 
                    aria-required="true"
                >
                @error('price')
                    <p id="price-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="stock" class="block mb-2 font-medium">Antal i lager</label>
                <input 
                    name="stock" 
                    id="stock" 
                    type="number"
                    min="0"
                    step="1"
                    class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md @error('stock') input-error @enderror" 
                    value="{{ old('stock') }}" 
                    required 
                    aria-required="true"
                >
                @error('stock')
                    <p id="stock-error" class="error-text mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-primary-1 px-6 py-2 inline-block rounded-md font-medium"
                    aria-label="Save product"
                >
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Save
                    </span>
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