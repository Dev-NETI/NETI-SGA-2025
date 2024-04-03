<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $role->name }}</x-td>
    <x-td>
        <x-create-button label="Add Role" wire:click="store({{ $role->id }})" />
    </x-td>
</tr>
