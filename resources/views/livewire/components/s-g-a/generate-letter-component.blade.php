<div class="grid sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-9 mt-8">
    <x-result-message />
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
            <x-submit-button label="Generate" x-on:click="isGenerated = !isGenerated" />
        </div>
    </form>

    <div
        class="h-[52rem] sm:col-span-1 md:col-start-3 md:col-span-3 lg:col-start-4 lg:col-span-6 md:-mt-16 lg:-mt-16
         border-sgaDarkBlue border-2 border-dashed ">

        @if ($isGenerated)
            <div class="flex flex-col">
                <x-pdf-view reportRoute="/generate/letter" referenceNumber="{{ $referenceNumber }}"
                    wire:click="storeLog()" wire:confirm="Are you sure you want to save this report?" />
            </div>
        @else
            <div class="flex justify-center">
                <h2 class="text-stone-700 text-2xl font-semibold mt-10">Generated report will be shown here!</h2>
            </div>
        @endif

    </div>

</div>
