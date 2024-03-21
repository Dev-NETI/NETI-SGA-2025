<x-main-content pageTitle="{{ $hash != null ? 'Update Vessel Type' : 'Create Vessel Type' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">

        <x-text-input name="vesselType" title="Vessel Type" wire:model="vesselType" type="text" />
        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>