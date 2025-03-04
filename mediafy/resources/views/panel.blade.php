<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-8 text-neutral-1">
 
    
    <main class="flex flex-row">
        <!-- Sidebar navigation -->
        <nav aria-label="Main Navigation" id="sidebar" class="flex flex-col p-4 w-[250px]">
            <div class="flex items-center space-x-2 mb-4">
                <h1 class="text-xl font-semibold">Admin Panel</h1>
            </div>
            <ul role="menu" class="text-neutral-4 text-xl flex flex-col gap-2">
                <li role="menuitem"><a href="/panel" class="text-neutral-1 hover:underline">Products</a></li>
                <li role="menuitem"><a href="/" class="text-neutral-1 hover:underline">Users</a></li>
                <li role="menuitem"><a href="/logout" class="text-neutral-1 hover:underline">Logout</a></li>
            </ul>
        </nav>
        
        <!-- Main content section -->
        <section id="maincontent" aria-label="Product Management" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4 pb-6 items-center">
                <h1 class="text-xl font-semibold">Product list</h1>
                <a href="/panel/addproduct" class="bg-primary-1 px-6 py-2 inline-block rounded-md" aria-label="Add new product">
                    Add new product
                </a>
            </header>
            
            <!-- Success message if present -->
            @if (session('success'))
                <div role="alert" class="bg-green-800 text-white p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Filter section -->
            <div id="filter" aria-label="Filter products" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7 mb-10">
                <form action="/panel" method="GET">
                    <div class="flex items-center gap-2">
                        <label for="platform-select" class="font-medium">Choose Platform: </label>
                        <select 
                            name="platform" 
                            id="platform-select" 
                            class="text-neutral-1 bg-secondary-1 border border-neutral-7 rounded px-2 py-1"
                            aria-label="Filter by platform"
                        >
                            <option value="ALL" {{ request('platform') == 'ALL' ? 'selected' : '' }}>All</option>
                            <option value="Xbox" {{ request('platform') == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                            <option value="Playstation" {{ request('platform') == 'Playstation' ? 'selected' : '' }}>Playstation</option>
                            <option value="Nintendo" {{ request('platform') == 'Nintendo' ? 'selected' : '' }}>Nintendo Switch</option>
                        </select>
                        <button 
                            type="submit" 
                            class="bg-primary-1 px-6 py-2 inline-block rounded-md"
                            aria-label="Apply platform filter"
                        >
                            Apply filter
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Products table -->
            <div id="productsTable" aria-label="Products list" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
                <h2 class="text-xl pb-4" id="products-heading">Alla produkter</h2>
                
                @if(count($titles) === 0)
                    <p>No products found. <a href="/panel/addproduct" class="underline">Add a new product</a>.</p>
                @else
                    <div class="overflow-x-auto">
                        <table aria-labelledby="products-heading" class="min-w-full table-auto">
                            <caption class="sr-only">List of products with their details and actions</caption>
                            <thead class="text-left">
                                <tr>
                                    <th scope="col" class="px-4 py-2">Title</th>
                                    <th scope="col" class="px-4 py-2">Platform</th>
                                    <th scope="col" class="px-4 py-2">Price</th>
                                    <th scope="col" class="px-4 py-2">Antal i lager</th>
                                    <th scope="col" class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($titles as $title)
                                    @foreach($title->products as $product)
                                        <tr>
                                            <td class="px-4 py-2">{{ $title->name }}</td>
                                            <td class="px-4 py-2">{{ $product->platform->type }}</td>
                                            <td class="px-4 py-2">{{ $product->price }}kr</td>
                                            <td class="px-4 py-2">{{ $product->stock }}st</td>
                                            <td class="px-4 py-2">
                                                <div class="flex gap-2">
                                                    <a 
                                                        href="{{ route('panel.product.edit', $product->id) }}" 
                                                        class="text-blue-500 hover:underline edit-icon" 
                                                        aria-label="Edit {{ $title->name }}"
                                                    >
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('delete', $product->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button 
                                                            type="submit" 
                                                            class="text-red-500 bg-transparent border-none cursor-pointer delete-icon" 
                                                            aria-label="Delete {{ $title->name }}"
                                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                                        >
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination controls -->
                    <div class="mt-4" aria-label="Pagination">
                        {{ $titles->appends(['platform' => request('platform')])->links() }}
                    </div>
                @endif
            </div>
        </section>
    </main>
</body>
</html>