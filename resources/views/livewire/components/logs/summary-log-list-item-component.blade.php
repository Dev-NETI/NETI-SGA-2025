<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $summary->reference_number }}</x-td>
    <x-td>{{ $summary->modified_by }}</x-td>
    <x-td>{{ $summary->updated_at }}</x-td>
    <td>
        <x-create-button label="Download" wire:click="show({{ $summary->id }})" />
    </td>
</tr>
