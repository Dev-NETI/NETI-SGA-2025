<form class="grid sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-6 mt-8" wire:submit.prevent="generate">
    @csrf
    <div class="sm:col-span-1 md:col-start-2 md:col-span-2 lg:col-start-3 lg:col-span-2">
        <x-text-input name="month" title="Select month" wire:model="month" type="month" />
        <x-select-input name="principal" title="Select principal" wire:model="principal" :data="$principalData"
            :hash="$hash" />
        <x-select-input name="vesselType" title="Select vessel type" wire:model="vesselType" :data="$vesselTypeData"
            :hash="$hash" />
        <x-submit-button label="Generate" />
    </div>
</form>
