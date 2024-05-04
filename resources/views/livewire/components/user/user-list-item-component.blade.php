<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $user->full_name }}</x-td>
    <x-td>{{ $user->email }}</x-td>
    <x-td>{{ $user->company->name }}</x-td>
    <x-td>{{ $user->department->name }}</x-td>
    <x-td>{{ $user->position->name }}</x-td>
    <x-td>
        <p class="text-sm font-bold">{{ $user->modified_by }}</p>
        <p class="text-sm text-red-800 font-semibold">{{ $user->updated_at }}</p>
    </x-td>
    <x-td>

        <x-action-dropdown :id="$user->id">
            <x-action-dropdown-item label="Edit" href="{{ route('users.edit', ['hash_id' => $user->hash]) }}" />
            <x-action-dropdown-item label="Assign Roles"
                href="{{ route('users.roles-index', ['hash_id' => $user->hash]) }}" />
            <x-action-dropdown-item label="Change Password"
                href="{{ route('users.edit-password', ['hash_id' => $user->hash, 'pw_id' => 1]) }}" />
            <x-action-dropdown-item label="Delete" wire:confirm="Are you sure you want to delete user?"
                wire:click="destroy({{ $user->id }})" />
        </x-action-dropdown>

    </x-td>
</tr>
