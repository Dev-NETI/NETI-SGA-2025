<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $user->full_name }}</x-td>
    <x-td>{{ $user->email }}</x-td>
    <x-td>{{ $user->company->name }}</x-td>
    <x-td>{{ $user->department->name }}</x-td>
    <x-td>{{ $user->modified_by }}</x-td>
    <x-td>{{ $user->updated_at }}</x-td>
    <td>
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown{{ $user->id }}"
            class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none 
            focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            . . .
        </button>

        <div id="dropdown{{ $user->id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('users.edit', ['hash_id' => $user->hash]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a href="{{ route('users.roles-index', ['hash_id' => $user->hash]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Assign
                        Roles</a>
                </li>
                <li>
                    <a href="{{ route('users.edit-password', ['hash_id' => $user->hash, 'pw_id' => 1]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Change
                        Password</a>
                </li>
                <li>
                    <a wire:confirm="Are you sure you want to delete vessel?" wire:click="destroy({{$user->id}})"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                </li>
            </ul>
        </div>
    </td>
</tr>
