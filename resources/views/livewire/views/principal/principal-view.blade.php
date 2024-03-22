<x-view-main-content pageTitle="{{ $title }}" wire:click="create('principal.create')">
    <x-result-message />
    <livewire:components.principal.principal-list-component />
</x-view-main-content>
