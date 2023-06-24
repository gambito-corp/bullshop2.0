<div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet"> --}}
    <livewire:styles />
    @stack('styles')
</div>
