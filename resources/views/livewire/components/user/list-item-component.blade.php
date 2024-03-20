<tr class="border-b border-gray-200 dark:border-gray-700">
    <th scope="row"
        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
        @if ($isRole == 1)
            {{ $data->name }}
        @else
            {{ $data->role->name }}
        @endif
    </th>
    <td class="px-6 py-4">
        @if ($isRole == 1)
            <button type="button"
                class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 
        dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" wire:click="store({{$data->id}})">Add Role</button>
        @else
            <button type="button"
                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 
                focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" wire:click="">Remove Role</button>
        @endif
    </td>
</tr>
