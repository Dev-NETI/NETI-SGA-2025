<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>
        @if ($isRole == 1)
            {{ $data->name }}
        @else
            {{ $data->role->name }}
        @endif
    </x-td>
    <td class="px-6 py-4">
        @if ($isRole == 1)
            <x-create-button label="Add Role" wire:click="store({{ $data->id }})" />
        @else
            <x-red-button label="Remove Role" wire:click="destroy({{ $data->id }})"
                wire:confirm="Are you want to delete this role?" />
        @endif

    </td>
</tr>
