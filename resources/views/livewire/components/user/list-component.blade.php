<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <x-th>{{$tableHeader}}</x-th>
                <x-th>Select</x-th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $item)
                    <livewire:components.user.list-item-component :user="$user" :data="$item" wire:key="{{ $item->id }}" isRole="{{$isRole}}" />
                @endforeach
            @else
            @endif
        </tbody>
    </table>
</div>
