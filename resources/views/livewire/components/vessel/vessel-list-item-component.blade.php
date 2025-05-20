<tr class="border-b border-gray-200 dark:border-gray-700  {{ $vessel->deleted_at ? 'bg-red-700' : '' }}">
    <x-td>{{ $vessel->code }}</x-td>
    <x-td>{{ $vessel->name }}</x-td>
    <x-td>{{ $vessel->prefix }}</x-td>
    <x-td>{{ $vessel->vessel_type->name }}</x-td>
    <x-td>{{ $vessel->principal->name }}</x-td>
    <x-td>{{ $vessel->serial_number }}</x-td>
    <x-td>{{ $vessel->remarks }}</x-td>
    <x-td>{{ $vessel->modified_by }}</x-td>
    <x-td>{{ $vessel->formatted_updated_date }}</x-td>
    
    <x-td>

        <x-action-dropdown :id="$vessel->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('vessel.edit', ['hash_id' => $vessel->hash]) }}" />
            <x-action-dropdown-item label="{{ $vessel->deleted_at ? 'Activate' : 'Deactivate'}}" 
                wire:confirm="Are you sure you want to {{$vessel->deleted_at ? 'Activate' : 'Deactivate'}} vessel?"
                wire:click="toggleActive({{ $vessel->id }})" />
        </x-action-dropdown>

    </x-td>
</tr>
