<div class="grid sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-9 mt-8">
    <x-result-message />
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

    <div
        class="h-[52rem] sm:col-span-1 md:col-start-3 md:col-span-3 lg:col-start-4 lg:col-span-6 md:-mt-16 lg:-mt-16
         border-sgaDarkBlue border-2 border-dashed ">

        @if ($isGenerated)
            <div class="flex flex-col">
                <x-pdf-view reportRoute="/generate/training-fee" referenceNumber="{{ $referenceNumber }}"
                    wire:click="storeLog()" wire:confirm="Are you sure you want to save this report?" />
            </div>
        @else
            <div class="flex justify-center">
                <h2 class="text-stone-700 text-2xl font-semibold mt-10">Generated report will be shown here!</h2>
            </div>
        @endif

    </div>


</div>
