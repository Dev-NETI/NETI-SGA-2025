<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $vessel->name }}</x-td>
    <x-td>{{ $vessel->vessel_type->name }}</x-td>
    <x-td>{{ $vessel->code }}</x-td>
    <x-td>{{ $vessel->training_fee }}</x-td>
    <x-td>{{ $vessel->modified_by }}</x-td>
    <x-td>{{ $vessel->formatted_updated_date }}</x-td>
    
    <td class="px-6 py-4 hover:bg-cyan-500 hover:text-lg hover:text-slate-100">

        <x-action-dropdown :id="$vessel->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('vessel.edit', ['hash_id' => $vessel->hash]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete vessel?"
                wire:click="destroy({{ $vessel->id }})" />
        </x-action-dropdown>

    </td>
</tr>
