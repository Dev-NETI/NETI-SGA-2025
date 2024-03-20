<tr class="border-b border-gray-200 dark:border-gray-700">
    <livewire:components.reusable.td label="{{ $company->name }}" />
    <livewire:components.reusable.td label="{{ $company->code }}" />
    <livewire:components.reusable.td label="{{ $company->modified_by }}" />
    <livewire:components.reusable.td label="{{ $company->updated_at }}" />
    <td class="px-6 py-4 hover:bg-cyan-500 hover:text-lg hover:text-slate-100">

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown{{ $company->id }}"
            class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none 
            focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            ...
        </button>

        <div id="dropdown{{ $company->id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('company.edit', ['hash_id' => $company->hash]) }}" wire:navigate
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a wire:confirm="Are you sure you want to delete company?" wire:click="destroy({{ $company->id }})"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                </li>
            </ul>
        </div>

    </td>
</tr>
