<div class="grid sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-9 mt-8">

    <form class="sm:col-span-1 md:col-start-1 md:col-span-1 lg:col-start-1 lg:col-span-2 flex-row"
        wire:submit.prevent="generate">
        @csrf
        <div>
            <x-text-input name="month" title="Select month" wire:model="month" type="month" />
        </div>
        <div>
            <x-select-input name="principal" title="Select principal" wire:model="principal" :data="$principalData"
                :hash="$hash" />
        </div>
        <div>
            <x-select-input name="vesselType" title="Select vessel type" wire:model="vesselType" :data="$vesselTypeData"
                :hash="$hash" />
        </div>
        <div>
            <x-submit-button label="Generate" />
        </div>
    </form>

    <x-pdf-view isGenerated="{{$isGenerated}}" reportRoute="/generate/training-fee" />

</div>
