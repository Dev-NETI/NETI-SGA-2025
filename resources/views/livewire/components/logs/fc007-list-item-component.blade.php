<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td>{{ $data->reference_number }}</x-td>
    <x-td>{{ $data->modified_by }}</x-td>
    <x-td>{{ $data->updated_at }}</x-td>
    <td>
        <x-create-button label="Download" wire:click="show({{ $data->id }})" />
    </td>
</tr>
