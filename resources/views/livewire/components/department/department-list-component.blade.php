<x-list-view :data="$departmentData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Department</x-th>
            <x-th>Company</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($departmentData) > 0)
            @foreach ($departmentData as $item)
                <livewire:components.department.department-list-item-component :department="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>