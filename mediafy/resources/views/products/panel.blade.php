<x-admin-layout
    title="Product Management - Admin Panel"
    contentLabel="Product Management"
    headerTitle="Product list">
    <x-slot name="headerActions">
        @if (auth()->user()->isAdmin())
        <a href="/panel/addproduct" class="bg-primary-1 px-6 py-2 inline-block rounded-md" aria-label="Add new product">
            Add new product
        </a>
        @endif
    </x-slot>

    <!-- Filter section -->
    <div id="filter" aria-label="Filter products" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7 mb-10">
        <form action="/panel" method="GET">
            <div class="flex items-center gap-2">
                <label for="platform-select" class="font-medium">Choose Platform: </label>
                <select
                    name="platform"
                    id="platform-select"
                    class="text-neutral-1 bg-secondary-1 border border-neutral-7 rounded px-2 py-1"
                    aria-label="Filter by platform">
                    <option value="ALL" {{ $platform == 'ALL' ? 'selected' : '' }}>All</option>
                    <option value="Xbox" {{ $platform == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                    <option value="Playstation" {{ $platform == 'Playstation' ? 'selected' : '' }}>Playstation</option>
                    <option value="Nintendo" {{ $platform == 'Nintendo' ? 'selected' : '' }}>Nintendo Switch</option>
                </select>
                <button
                    type="submit"
                    class="bg-primary-1 px-6 py-2 inline-block rounded-md"
                    aria-label="Apply platform filter">
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
                        @if (auth()->check() && auth()->user()->isAdmin())
                        <th scope="col" class="px-4 py-2">Actions</th>
                        @endif
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
                        @if (auth()->user()->isAdmin())
                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <a
                                    href="{{ route('panel.product.edit', $product->id) }}"
                                    class="text-blue-500 hover:underline edit-icon"
                                    aria-label="Edit {{ $title->name }}">
                                    Edit
                                </a>
                                <form action="{{ route('delete', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-red-500 bg-transparent border-none cursor-pointer delete-icon"
                                        aria-label="Delete {{ $title->name }}"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
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
</x-admin-layout>