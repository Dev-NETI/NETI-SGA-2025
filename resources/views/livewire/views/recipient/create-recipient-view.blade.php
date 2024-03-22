<x-main-content pageTitle="{{ $hash != null ? 'Update Recipient' : 'Create Recipient' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">
        
        <x-text-input name="name" title="Name" wire:model="name" type="text" />
        <x-select-input name="principal" title="Principal" wire:model="principal" :data="$principalData" :hash="$hash" />
        <x-text-input name="department" title="Department" wire:model="department" type="text" />
        <x-text-input name="position" title="Position" wire:model="position" type="text" />

        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>