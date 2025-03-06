<x-layout title="Login - Mediafy Admin">
    <x-slot name="head">
        <!-- Preload fonts for better performance -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    </x-slot>
    
    <div class="grid md:grid-cols-2 h-[100vh] font-poppins">
        <!-- Login Section -->
        <main class="bg-white flex flex-col justify-center items-center p-4">
            <header>
                <h1 class="text-4xl font-semibold mb-6 text-center my-4">Mediafy Admin</h1>
            </header>
            
            <!-- Display validation errors with appropriate ARIA roles -->
            @if ($errors->any())
                <div role="alert" aria-live="assertive" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p><strong>Error:</strong> {{ $errors->first() }}</p>
                    </div>
                </div>
            @endif
            
            <div id="loginform" class="text-center p-6 border-2 border-gray-100 rounded-3xl w-full max-w-md">
                <h2 class="text-2xl font-medium mb-4">LOGIN</h2>

                <form action="/login" method="post" novalidate>
                    <div class="mb-4">
                        <label for="email" class="block text-left text-gray-700 mb-2 font-medium">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required
                            autocomplete="email"
                            aria-required="true"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 bg-gray-100 placeholder-gray-500"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-left text-gray-700 mb-2 font-medium">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            autocomplete="current-password"
                            aria-required="true"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 bg-gray-100 placeholder-gray-500"
                        >
                    </div>
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <button 
                        type="submit" 
                        class="w-full mt-6 bg-gradient-to-r from-purple-1 to-purple-2 px-4 py-2 rounded-xl text-white shadow-lg hover:bg-gradient-to-l focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                    >
                        <span class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Logga in
                        </span>
                    </button>
                </form>
            </div>
        </main>

        <!-- Decorative image section with proper aria-hidden -->
        <section class="bg-gradient-to-bl from-purple-1 to-purple-2 relative h-[100vh] hidden md:block" aria-hidden="true">
            <div class="absolute inset-0 z-0">
                <img 
                    src="{{ asset('images/logindesign.png') }}" 
                    class="w-full h-full object-cover"
                    alt=""
                    role="presentation"
                >
            </div>
        </section>
    </div>
</x-layout>