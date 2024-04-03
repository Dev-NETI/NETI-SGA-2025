<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $role->role->name }}</x-td>
    <x-td>
        <x-red-button label="Remove Role" wire:click="destroy({{ $role->id }})"
            wire:confirm="Are you want to delete this role?" />
    </x-td>
</tr>
