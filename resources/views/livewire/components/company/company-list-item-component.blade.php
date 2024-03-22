<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $company->name }}</x-td>
    <x-td>{{ $company->code }}</x-td>
    <x-td>{{ $company->modified_by }}</x-td>
    <x-td>{{ $company->updated_at }}</x-td>
    <td class="px-6 py-4 hover:bg-cyan-500 hover:text-lg hover:text-slate-100">

        <x-action-dropdown :id="$company->id">
            <x-action-dropdown-item label="Edit"
                href="{{ route('company.edit', ['hash_id' => $company->hash]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete company?"
                wire:click="destroy({{ $company->id }})" />
        </x-action-dropdown>

    </td>
</tr>
