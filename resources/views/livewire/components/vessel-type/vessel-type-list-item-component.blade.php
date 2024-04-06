<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $vessel->name }}</x-td>
    <x-td>

        <x-action-dropdown :id="$vessel->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('vessel-type.edit', ['hash_id' => $vessel->hash]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete vessel?"
                wire:click="destroy({{ $vessel->id }})" />
        </x-action-dropdown>

    </x-td>
</tr>
