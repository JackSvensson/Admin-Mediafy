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
            <div class="flex items-center space-x-2 mb-4">
                <h1 class="text-xl font-semibold">Admin Panel</h1>
            </div>
            <ul>
                <li>Products</li>
                <li>Users</li>
                <li>Logout</li>
            </ul>
        </section>
        <section id="maincontent" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4 pb-6 items-center">
                <h1 class="text-xl font-semibold">Add new product</h1>
            </header>
            <div id="addProductForm" class="bg-secondary-1 rounded-md p-4 border-1 border-neutral-7">
                <form method='POST' action="/product">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block mb-2">Title</label>
                        <input name="title" id="title" type="text" class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md" required />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Platforms</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="platforms[]" value="Playstation" class="mr-2 bg-neutral-8 border-neutral-7">
                                Playstation
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="platforms[]" value="Xbox" class="mr-2 bg-neutral-8 border-neutral-7">
                                Xbox
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="platforms[]" value="Nintendo" class="mr-2 bg-neutral-8 border-neutral-7">
                                Nintendo Switch
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block mb-2">Price (kr)</label>
                        <input name="price" id="price" type="number" class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md" required />
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block mb-2">Antal i lager</label>
                        <input name="stock" id="stock" type="number" class="w-full bg-neutral-8 text-neutral-1 border-1 border-neutral-7 p-2 rounded-md" required />
                    </div>

                    <button type="submit" class="bg-primary-1 px-6 py-2 inline-block rounded-md">
                        Save
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>