<x-list-view :data="$summaryLogData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Information</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($summaryLogData) > 0)
            @foreach ($summaryLogData as $item)
                <livewire:components.logs.summary-log-list-item-component :summary="$item"
                    wire:key="{{ $item->id }}" statusId="{{ $statusId }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>