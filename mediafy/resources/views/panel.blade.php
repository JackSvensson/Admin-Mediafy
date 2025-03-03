<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-8 text-neutral-1">
    <main class="flex flex-row">
        <section id="sidebar" class="flex flex-col p-4 w-[250px] bg-neutral-7">
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
        <section id="maincontent" class="bg-neutral-5 w-full h-[100vh] px-10">
            <header class="flex justify-between py-4">
                <h1 class="text-xl font-semibold">Product list</h1>
                <a href="/addproduct" class="bg-primary-1 px-6 py-2 inline-block rounded-md font-medium hover:bg-primary-2"> Add new product</a>
            </header>
            <div id="filterList">Filter</div>
            <div id="productsTable">Produkter...</div>
        </section>
    </main>
</body>


</html>