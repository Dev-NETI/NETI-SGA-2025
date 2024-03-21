<x-view-main-content pageTitle="{{ $title }}" wire:click="create('department.create')">
    <x-result-message />
    <livewire:components.department.department-list-component />
</x-view-main-content>