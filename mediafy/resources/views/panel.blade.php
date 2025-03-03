<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-8 text-neutral-1">
    <main class="flex flex-row">
        <section id="sidebar" class="flex flex-col pt-3 px-4  border-r-1 border-neutral-7">
            <!-- Flex container for sidebar -->
            <img src="{{ asset('images/mediafyadmin.png') }}" class="pb-2" />

            <ul class="text-neutral-4 text-xl flex flex-col gap-2">
                <li><a href="/" class="text-neutral-1">Products</a></li>
                <li><a href="/">Users</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </section>
        <section id="maincontent" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4  pb-6 items-center">
                <h1 class="text-xl font-semibold">Product list</h1>
                <a href="/addproduct" class="bg-primary-1 px-6 py-2 inline-block rounded-md font-medium hover:bg-primary-2"> Add new product</a>
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
                        <tr>
                            <td class="px-4 py-2">Star wars</td>
                            <td class="px-4 py-2">Playstation</td>
                            <td class="px-4 py-2">359kr</td>
                            <td class="px-4 py-2">2st</td>
                            <td class="px-4 py-2">
                                <a href="/edit" class="text-blue-500">Edit</a> |
                                <a href="/delete" class="text-red-500">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Halo</td>
                            <td class="px-4 py-2">Xbox</td>
                            <td class="px-4 py-2">200kr</td>
                            <td class="px-4 py-2">10st</td>
                            <td class="px-4 py-2">
                                <a href="/edit" class="text-blue-500">Edit</a> |
                                <a href="/delete" class="text-red-500">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>
    </main>
</body>


</html>