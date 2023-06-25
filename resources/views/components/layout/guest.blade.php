<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $titulo }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>

    <body class="bg-gray-200">
        <main>
            {{ $slot }}
        </main>
        <!-- Alpine.js -->
        @stack('scripts')
    </body>

    </html>
</div>
