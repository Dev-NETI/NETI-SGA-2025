<x-view-main-content pageTitle="{{ $title }}" wire:click="create('vessel-type.create')">
    <x-result-message />
    <livewire:components.vessel-type.vessel-type-list-component />
</x-view-main-content>