<x-main-content pageTitle="{{ $hash != null ? 'Update Vessel' : 'Create Vessel' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">

        <x-text-input name="vessel" title="Vessel" wire:model="vessel" type="text" />
        <x-select-input name="vesselType" title="Vessel Type" wire:model="vesselType" :data="$vesselTypeData" :hash="$hash" />
        <x-text-input name="code" title="Code" wire:model="code" type="text" />
        <x-text-input name="trainingFee" title="Training Fee" wire:model="trainingFee" type="text" />

        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>
