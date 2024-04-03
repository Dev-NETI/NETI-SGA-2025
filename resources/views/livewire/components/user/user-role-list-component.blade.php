<x-list-view :data="$userRoleData" wire:model.live="search">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <x-th>Role</x-th>
            <x-th>Action</x-th>
        </tr>
    </thead>
    <tbody>
        @if (count($userRoleData) > 0)
            @foreach ($userRoleData as $item)
                <livewire:components.user.user-role-list-item-component :role="$item" wire:key="{{ $item->id }}"
                    :user="$user" :hash="$hash" />
            @endforeach
        @else
        @endif
    </tbody>
</x-list-view>
