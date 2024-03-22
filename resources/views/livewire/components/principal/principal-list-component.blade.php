<x-list-view :data="$principalData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Name</x-th>
            <x-th>Address</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($principalData) > 0)
            @foreach ($principalData as $item)
                <livewire:components.principal.principal-list-item-component :principal="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
