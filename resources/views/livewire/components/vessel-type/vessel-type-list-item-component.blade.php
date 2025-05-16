<tr class="border-b border-gray-200 dark:border-gray-700 {{ $vessel->deleted_at ? 'bg-red-700' : ''}}">
    <x-td>{{ $vessel->name }}</x-td>
    <x-td>{{ $vessel->training_fee }}</x-td>
    <x-td>

        <x-action-dropdown :id="$vessel->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('vessel-type.edit', ['hash_id' => $vessel->hash]) }}" />
            <x-action-dropdown-item label="{{ $vessel->deleted_at ? 'Activate' : 'Deactivate' }}"
                wire:confirm="Are you sure you want to {{ $vessel->deleted_at ? 'activate' : 'deactivate' }} vessel?"
                wire:click="toggleActive({{ $vessel->id }})" />
        </x-action-dropdown>

    </x-td>
</tr>
