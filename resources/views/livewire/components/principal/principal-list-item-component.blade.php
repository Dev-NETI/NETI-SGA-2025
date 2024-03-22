<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $principal->name }}</x-td>
    <x-td>{{ $principal->address }}</x-td>
    <x-td>{{ $principal->modified_by }}</x-td>
    <x-td>{{ $principal->updated_at }}</x-td>
    <td class="px-6 py-4 hover:bg-cyan-500 hover:text-lg hover:text-slate-100">

        <x-action-dropdown :id="$principal->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('principal.edit', ['hash_id' => $principal->hash]) }}" />
            {{-- <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete principal?"
                wire:click="destroy({{ $principal->id }})" /> --}}
        </x-action-dropdown>

    </td>
</tr>
