<x-list-view :data="$recipientData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Name</x-th>
            <x-th>Principal</x-th>
            <x-th>Department</x-th>
            <x-th>Position</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($recipientData) > 0)
            @foreach ($recipientData as $item)
                <livewire:components.recipient.recipient-list-item-component :recipient="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
