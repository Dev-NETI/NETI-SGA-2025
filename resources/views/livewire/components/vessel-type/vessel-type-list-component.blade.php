<x-list-view :data="$vesselTypeData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Name</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($vesselTypeData) > 0)
            @foreach ($vesselTypeData as $item)
                <livewire:components.vessel-type.vessel-type-list-item-component :vessel="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
