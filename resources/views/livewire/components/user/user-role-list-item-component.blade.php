<x-ul-item :title="$role->role->name">
    <x-red-button label="Remove Role" wire:click="destroy({{ $role->id }})"
        wire:confirm="Are you want to delete this role?" />
</x-ul-item>
