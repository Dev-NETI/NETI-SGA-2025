<x-list-view :data="$vesselData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Code</x-th>
            <x-th>Vessel</x-th>
            <x-th>Type</x-th>
            <x-th>Principal</x-th>
            <x-th>Serial #</x-th>
            <x-th>Remarks</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($vesselData) > 0)
            @foreach ($vesselData as $item)
                <livewire:components.vessel.vessel-list-item-component 
                :vessel="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
