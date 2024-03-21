<x-view-main-content pageTitle="{{ $title }}" wire:click="create('users.create')">
    <x-result-message />
    <livewire:components.user.user-list-component />
</x-view-main-content>
