<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <livewire:styles />
    @stack('styles')
</div>
