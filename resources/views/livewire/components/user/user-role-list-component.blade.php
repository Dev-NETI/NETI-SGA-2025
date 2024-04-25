<x-ul-search :data="$userRoleData" wire:model.live="search">

    @if (count($userRoleData) > 0)
        @foreach ($userRoleData as $item)
            <livewire:components.user.user-role-list-item-component :role="$item" wire:key="{{ $item->id }}"
                :user="$user" :hash="$hash" />
        @endforeach
    @else
    @endif

</x-ul-search>