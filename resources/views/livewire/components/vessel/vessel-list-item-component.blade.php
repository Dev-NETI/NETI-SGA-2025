<tr class="border-b border-gray-200 dark:border-gray-700">
    <th scope="row"
        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
        {{ $vessel->name }}
    </th>
    <td class="px-6 py-4">
        {{ $vessel->vessel_type->name }}
    </td>
    <td class="px-6 py-4">
        {{ $vessel->code }}
    </td>
    <td class="px-6 py-4">
        {{ $vessel->training_fee }}
    </td>
    <td class="px-6 py-4">
        {{ $vessel->modified_by }}
    </td>
    <td class="px-6 py-4">
        {{$vessel->formatted_updated_date}}
    </td>
    <td class="px-6 py-4">

        {{-- <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown{{ $vessel->id }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
            text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 16 3">
                <path
                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown{{ $vessel->id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('vessel-type.edit', ['hash_id' => $vessel->hash]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        wire:navigate>Edit</a>
                </li>
                <li>
                    <a wire:confirm="Are you sure you want to delete vessel type?"
                        wire:click="destroy({{ $vessel->id }})"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                </li>
            </ul>
        </div> --}}

    </td>
</tr>
