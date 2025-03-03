<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediafy Admin</title>

    @vite('resources/css/app.css')

    <!-- Add this inside the <head> tag of your main layout (app.blade.php) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class=" font-poppins">
    @if ($errors->any())
    <p>
        <u>{{ $errors->first() }}</u>
    </p>
    @endif
    <div class="grid grid-cols-2 h-[100vh]">
        <!-- Login Section -->
        <section class="bg-white flex flex-col justify-center items-center">
            <h1 class="text-4xl font-semibold mb-6 text-center my-4">Mediafy Admin</h1>
            <div id="loginform" class="text-center p-6 border-2 border-gray-100 rounded-3xl">
                <h2 class="text-2xl font-medium mb-4">LOGIN</h2>

                <form action="/login" method="post">
                    <div class="mb-4">
                        <label for="email" class="block text-left text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 bg-gray-100 placeholder-gray-500">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-left text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 bg-gray-100 placeholder-gray-500">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" class="w-full mt-6 bg-gradient-to-r from-purple-1 to-purple-2 px-4 py-2 rounded-xl text-white shadow-lg hover:bg-gradient-to-l">
                        Logga in
                    </button>
                </form>

            </div>
        </section>

        <!-- Image or Background Section -->
        <section class="bg-gradient-to-bl from-purple-1 to-purple-2 relative h-[100vh]">

            <!-- <img src="{{ asset('images/start.png') }}" alt="Start Image" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"> -->


            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/logindesign.png') }}" class="w-full h-full object-cover">
            </div>
        </section>

    </div>

</body>

</html>