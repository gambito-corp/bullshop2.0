<div class="p-4">
    <div class="flex items-center space-x-4">
        <div>
            <label for="paginate" class="text-gray-500">Mostrar:</label>
            <select wire:model="paginate" id="paginate"
                class="block w-24 px-2 py-1 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-400">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="40">40</option>
                <option value="60">60</option>
                <option value="80">80</option>
                <option value="100">100</option>
            </select>
        </div>
        <div>
            <label for="search" class="text-gray-500">Buscar:</label>
            <input wire:model.debounce.300ms="search" type="text" id="search"
                class="block w-full px-2 py-1 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-400">
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('name')">
                    Nombre
                    <i
                        class="fas @if ($sort === 'name') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('email')">
                    Correo
                    <i
                        class="fas @if ($sort === 'email') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('status')">
                    Activo
                    <i
                        class="fas @if ($sort === 'status') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('role')">
                    Rol
                    <i
                        class="fas @if ($sort === 'role') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('image')">
                    Imagen
                    <i
                        class="fas @if ($sort === 'image') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('created_at')">
                    Fecha de Alta
                    <i
                        class="fas @if ($sort === 'created_at') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('deleted_at')">
                    Fecha de Baja
                    <i
                        class="fas @if ($sort === 'deleted_at') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->image }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->deleted_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if (
                            $user->id !== auth()->user()->id &&
                                auth()->user()->can('impersonar usuario'))
                            <a class="px-4 py-2 text-xs font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600"
                                wire:click="impersonateUser('{{ $user->id }}')"
                                title="Impersonar a: {{ $user->name }}">
                                <i class="fas fa-user-secret"></i>
                            </a>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
