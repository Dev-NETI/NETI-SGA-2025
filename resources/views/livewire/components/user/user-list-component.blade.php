<x-list-view :data="$userData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Name</x-th>
            <x-th>Email</x-th>
            <x-th>Company</x-th>
            <x-th>Department</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($userData) > 0)
            @foreach ($userData as $item)
                <livewire:components.user.user-list-item-component :user="$item" wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>