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
                    wire:click="sort('address')">
                    Dirección
                    <i
                        class="fas @if ($sort === 'address') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('phone')">
                    Teléfono
                    <i
                        class="fas @if ($sort === 'phone') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                    wire:click="sort('taxpayer_id')">
                    ID Contribuyente
                    <i
                        class="fas @if ($sort === 'taxpayer_id') fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }} @endif"></i>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($clients as $client)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->address }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->taxpayer_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
