<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                    {{$tableHeader}}
                </th>
                <th scope="col" class="px-6 py-3">
                    Select
                </th>
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
