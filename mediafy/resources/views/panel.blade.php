<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-8 text-neutral-1">
    <main class="flex flex-row">
        <section id="sidebar" class="flex flex-col p-4 w-[250px]">
            <!-- Flex container for sidebar -->
            <img src="{{ asset('images/mediafyadmin.png') }}" class="pb-2" />

            <ul class="text-neutral-4 text-xl flex flex-col gap-2">
                <li><a href="/" class="text-neutral-1">Products</a></li>
                <li><a href="/">Users</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </section>
        <section id="maincontent" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4 pb-6 items-center">
                <h1 class="text-xl font-semibold">Product list</h1>
                <a href="/panel/addproduct" class="bg-primary-1 px-6 py-2 inline-block rounded-md">Add new product</a>
            </header>
            <div id="productsTable" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
                <h2 class="text-xl pb-4">Alla produkter</h2>
                <table class="min-w-full table-auto">
                    <thead class="text-left">
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Platform</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Antal i lager</th>
                            <th class="px-4 py-2"></th>
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
                                <a href="/edit" class="text-blue-500">Edit</a> |
                                <form action="{{ route('delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 bg-transparent border-none cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>