<x-list-view :data="$summaryLogData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 ml-4 mr-4">
        <tr>
            <x-th class="w-4/12">Reference #</x-th>
            <x-th class="w-4/12">Details</x-th>
            <x-th class="w-4/12">Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($summaryLogData) > 0)
            @foreach ($summaryLogData as $item)
                <livewire:components.s-g-a.rejected-summary-report-list-item-component :data="$item" wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
