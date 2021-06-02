<div>
    <div class="bg-white shadow-md rounded-md">
        <div class="">
            <table class="w-full">
                <thead class="border-b">
                <tr>
                    @foreach($columns as $column)
                        <th class="text-md font-medium text-gray-500 p-2">{{ $renderTableColumn($column) }}</th>
                    @endforeach

                    <th class="text-md font-medium text-gray-500 p-2">Actions</th>
                </tr>
                </thead>

                <tbody class="py-3 w-full">
                @forelse($host_admins as $host_admin)
                    <tr class="hover:bg-gray-100">
                        @foreach($columns as $columnkey => $columnvalue)
                            <td class="p-2 text-center text-gray-400">{{ $renderModelField($host_admin, $columnkey) }}</td>
                        @endforeach

                        <td class="p-2 text-center text-gray-400">
                            <x-button class="bg-red-400" wire:click="handleUserDelete({{ $host_admin->id  }})">Delete</x-button>
                            <x-button class="bg-blue-400" wire:click="handleUserDelete({{ $host_admin->id  }})">Edit</x-button>
                            <x-button class="bg-green-400" wire:click="handleUserDelete({{ $host_admin->id  }})">Add Org</x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $columns->count() }}" class="align-middle text-center text-gray-400">No users
                            found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-3 py-2 border-t">
            {{ $host_admins->links() }}
        </div>
    </div>
</div>
