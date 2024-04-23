<x-ul>

    @foreach ($emailData as $item)

        <x-li name="{{ $item->user->full_name }}" email="{{ $item->user->email }}" modified="{{ $item->modified_by }}"
            timestamp="{{ $item->updated_at }}">

            <x-cog-dropdown :id="$item->id">
                    <x-action-dropdown-item label="Delete" wire:click="destroy({{ $item->id }})" wire:confirm="Are you sure you want to delete email recipient?" />
            </x-cog-dropdown>

        </x-li>
    @endforeach

</x-ul>
