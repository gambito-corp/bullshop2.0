<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $titulo }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet"> --}}
        @stack('styles')
    </head>

    <body class="bg-gray-200">
        <main>
            {{ $slot }}
        </main>
        <!-- Alpine.js -->
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
        @stack('scripts')
    </body>

    </html>
</div>
