<x-layout :title="$title">
    <main class="flex flex-row">
        <!-- Sidebar navigation with proper semantic markup -->
        <nav aria-label="Main Navigation" id="sidebar" class="flex flex-col p-4 w-[250px]">
            <div class="flex items-center space-x-2 mb-4">
                <h1 class="text-xl font-semibold">Admin Panel</h1>
            </div>
            <ul role="menu" class="text-neutral-4 text-xl flex flex-col gap-2">
                <li role="menuitem"><a href="/panel" class="text-neutral-1 hover:underline">Products</a></li>
                <li role="menuitem"><a href="/logout" class="text-neutral-1 hover:underline">Logout</a></li>
            </ul>
        </nav>

        <!-- Main content section -->
        <section id="mainContent" aria-label="{{ $contentLabel ?? 'Content' }}" class="w-full h-[100vh] px-10">
            <header class="flex justify-between pt-4 pb-6 items-center">
                <h2 class="text-xl font-semibold">{{ $headerTitle }}</h2>
                {{ $headerActions ?? '' }}
            </header>

            <!-- Success/Error messages -->
            @if (session('success'))
            <div role="alert" class="bg-green-800 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div role="alert" aria-live="assertive" class="bg-red-900 text-white p-4 mb-4 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="text-lg font-bold">Please fix the following errors:</h3>
                </div>
                <ul class="list-disc pl-10 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Main content -->
            {{ $slot }}
        </section>
    </main>
</x-layout>