<x-list-view :data="$fc007LogData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 mx-4">
        <tr>
            <x-th class="w-4/12">Reference #</x-th>
            <x-th class="w-4/12">Details</x-th>
            <x-th class="w-4/12">Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($fc007LogData) > 0)
            @foreach ($fc007LogData as $item)
                <livewire:components.s-g-a.rejected-training-report-list-item-component :data="$item" :vessel="$vessel"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
