<div class="grid sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-9 mt-8">

    <form class="sm:col-span-1 md:col-start-1 md:col-span-1 lg:col-start-1 lg:col-span-2 flex-row"
        wire:submit.prevent="generate">
        @csrf
        <div>
            <x-text-input name="month" title="Select month" type="month" wire:model="month" />
        </div>
        <div>
            <x-select-input name="principal" title="Select Principal" wire:model.live="principal" :data="$principalData"
                :hash="$hash" />
        </div>
        <div>
            <x-select-input name="recipient" title="Select Recipient" wire:model="recipient" :data="$recipientData"
                :hash="$hash" />
        </div>
        <div>
            <x-select-input name="signature" title="Select Signature" wire:model="signature" :data="$userData"
                :hash="$hash" />
        </div>
        <div>
            <x-submit-button label="Generate" />
        </div>
    </form>

    <x-pdf-view isGenerated="{{$isGenerated}}" reportRoute="/generate/letter" />

</div>
