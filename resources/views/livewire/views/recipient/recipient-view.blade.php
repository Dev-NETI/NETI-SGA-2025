<x-view-main-content pageTitle="{{ $title }}" wire:click="create('recipient.create')">
    <x-result-message />
    <livewire:components.recipient.recipient-list-component />
</x-view-main-content>
