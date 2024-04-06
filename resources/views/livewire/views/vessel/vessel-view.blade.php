<x-view-main-content pageTitle="{{ $title }}" wire:click="create('vessel.create')">
    <x-result-message />
    <livewire:components.vessel.vessel-list-component />
</x-view-main-content>
