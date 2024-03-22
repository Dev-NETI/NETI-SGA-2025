<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $department->name }}</x-td>
    <x-td>{{ $department->company->name }}</x-td>
    <x-td>{{ $department->modified_by }}</x-td>
    <x-td>{{ $department->updated_at }}</x-td>
    <td class="px-6 py-4 hover:bg-cyan-500 hover:text-lg hover:text-slate-100">

        <x-action-dropdown :id="$department->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('department.edit', ['hash_id' => $department->hash]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete department?"
                wire:click="destroy({{ $department->id }})" />
        </x-action-dropdown>
        
    </td>
</tr>
