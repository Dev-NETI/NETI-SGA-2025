<form class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-6 mt-8" wire:submit.prevent="generate">
    @csrf
    <div class="sm:col-span-1 md:col-start-2 lg:col-start-3 lg:col-span-2">
        <x-text-input name="month" title="Select month" type="month" wire:model="month" />
        <x-select-input name="principal" title="Select Principal" wire:model.live="principal" :data="$principalData"
            :hash="$hash" />
        <x-select-input name="recipient" title="Select Recipient" wire:model="recipient" :data="$recipientData"
            :hash="$hash" />
        <x-select-input name="signature" title="Select Signature" wire:model="signature" :data="$userData"
            :hash="$hash" />
</div>
    <div class="sm:col-span-1 md:col-start-2 lg:col-start-3 lg:col-span-2">
        <x-submit-button label="Generate" />
    </div>
</form>
