<x-ul-item :title="$role->name">
    <x-create-button label="Add Role" wire:click="store({{ $role->id }})" />
</x-ul-item>
