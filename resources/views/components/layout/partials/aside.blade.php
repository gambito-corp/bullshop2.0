<aside :class="open ? 'w-2/12' : 'w-1/24'" class="h-screen p-6 text-white transition-all duration-300 bg-purple-600">
    <!-- Contenido del sidebar -->
    <nav>
        <ul>
            <li><a href="/route1">Item 1</a></li>
            <li><a href="/route2">Item 2</a></li>
            <!-- Añade tantos elementos como necesites -->
        </ul>
    </nav>
</aside>

@push('styles')
    <style>
        .w-1\/24 {
            width: 4.16667%;
        }
    </style>
@endpush
