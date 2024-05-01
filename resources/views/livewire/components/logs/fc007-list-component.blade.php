<x-list-view :data="$fc007LogData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Information</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($fc007LogData) > 0)
            @foreach ($fc007LogData as $item)
                <livewire:components.logs.fc007-list-item-component :data="$item" statusId="{{ $statusId }}"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
