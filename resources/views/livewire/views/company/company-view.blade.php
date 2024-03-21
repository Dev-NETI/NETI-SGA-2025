<x-view-main-content pageTitle="{{ $title }}" wire:click="create('company.create')">
    <x-result-message />
    <livewire:components.company.company-list-component />
</x-view-main-content>