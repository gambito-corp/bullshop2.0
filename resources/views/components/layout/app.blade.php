<div>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ open: false }">
    <head>
        <x-layout.partials.head>{{$titulo}}</x-layout.partials.head>
    </head>
    <body class="font-sans antialiased">
    
    <div class="min-h-screen bg-gray-100">
        <x-layout.partials.header></x-layout.partials.header>
    
        <div class="flex">
            <x-layout.partials.aside></x-layout.partials.aside>
            <main class="w-full">
                {{ $slot }}
                {{-- <footer class="py-4 bg-gray-200">
                    Footer
                </footer> --}}
            </main>
        </div>
    </div>
    
    @stack('modals')
    <x-layout.partials.scripts></x-layout.partials.scripts>
    </body>
    </html>
</div>