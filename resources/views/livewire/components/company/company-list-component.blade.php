<x-list-view :data="$companyData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Company</x-th>
            <x-th>Code</x-th>
            <x-th>Address</x-th>
            <x-th>Is Principal?</x-th>
            <x-th>Modified By</x-th>
            <x-th>Modified</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($companyData) > 0)
            @foreach ($companyData as $item)
                <livewire:components.company.company-list-item-component :company="$item"
                    wire:key="{{ $item->id }}" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>