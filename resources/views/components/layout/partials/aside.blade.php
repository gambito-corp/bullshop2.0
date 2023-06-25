<aside :class="open ? 'w-2/12 transition-width duration-500' : 'w-1/24 transition-width duration-500'"
    class="h-screen p-6 text-white bg-purple-600">
    <!-- Contenido del sidebar -->
    <nav>
        <ul>
            <li>
                <a href="{{ route('admin.users.index') }}">
                    <div class="flex items-center py-2 my-2">
                        <i class="mr-2 fas fa-users"></i> <!-- Icono para la opción de menú -->
                        <span x-show="open" class="md:inline-block">Gestion de Usuarios</span>
                        <!-- Texto para la opción de menú -->
                    </div>
                </a>
                <hr> <!-- Línea horizontal debajo de la opción de menú -->
            </li>
            <li>
                <a href="{{ route('admin.clients.index') }}">
                    <div class="flex items-center py-2 my-2">
                        <i class="mr-2 fas fa-address-book"></i> <!-- Icono para la opción de menú -->
                        <span x-show="open" class="md:inline-block">Gestion de Clientes</span>
                        <!-- Texto para la opción de menú -->
                    </div>
                </a>
                <hr> <!-- Línea horizontal debajo de la opción de menú -->
            </li>
            <li>
                <a href="/route2">
                    <div class="flex items-center">
                        <i class="mr-2 fas fa-cog"></i> <!-- Icono para la opción de menú -->
                        <span x-show="open" class="md:inline-block">Item 2</span>
                        <!-- Texto para la opción de menú -->
                    </div>
                </a>
                <hr> <!-- Línea horizontal debajo de la opción de menú -->
            </li>
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
