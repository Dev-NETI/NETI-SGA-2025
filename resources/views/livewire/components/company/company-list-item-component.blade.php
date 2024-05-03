<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $company->name }}</x-td>
    <x-td>{{ $company->code }}</x-td>
    <x-td>{{ $company->address }}</x-td>
    <x-td>{{ $company->modified_by }}</x-td>
    <x-td>{{ $company->updated_at }}</x-td>
    <x-td>

        <x-action-dropdown :id="$company->id">
            <x-action-dropdown-item label="Edit" href="{{ route('company.edit', ['hash_id' => $company->hash]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete company?"
                wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                wire:click="destroy({{ $company->id }})" />
        </x-action-dropdown>

    </x-td>
</tr>
