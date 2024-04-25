<x-ul-search :data="$roleData" wire:model.live="search">

    @if (count($roleData) > 0)
        @foreach ($roleData as $item)
            <livewire:components.user.role-list-item-component :role="$item" wire:key="{{ $item->id }}"
                :user="$user" :hash="$hash" />
        @endforeach
    @else
    @endif

</x-ul-search>