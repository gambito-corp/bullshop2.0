<header class="flex items-center justify-between w-full h-12 px-6 text-white bg-purple-600">
    <!-- Botón de la hamburguesa -->
    <div class="mr-8">
        <x-layout.partials.header.hamburgesa></x-layout.partials.header.hamburgesa>
    </div>

    <!-- Logo -->
    <div>
        <x-layout.partials.header.logo></x-layout.partials.header.logo>
    </div>
    
    <!-- Dropdown de perfil -->
    <div x-data="{ open: false }" @click.away="open = false">
        <button @click="open = !open" class="relative z-10 block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
            <img class="object-cover w-full h-full" src="/path/to/your/profile/image.jpg" alt="Your Name">
        </button>

        <!-- Dropdown Body -->
        <div x-show="open" class="absolute right-0 w-48 py-2 mt-2 bg-white rounded-lg shadow-xl">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 capitalize hover:bg-blue-500 hover:text-white">
                Your profile
            </a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 capitalize hover:bg-blue-500 hover:text-white">
                Your settings
            </a>
            <a href="{{ route('auth.logout') }}"
            class="block px-4 py-2 text-sm text-gray-700 capitalize hover:bg-blue-500 hover:text-white"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign out
            </a>

            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</header>
