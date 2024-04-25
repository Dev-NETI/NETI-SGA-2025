<x-view-main-content-v2 pageTitle="{{ $title }}">

    <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-6">

        <div class="col-span-1 md:col-span-3 lg:col-span-4">
            <livewire:components.logs.fc007-list-component statusId="{{ $processId }}" />
        </div>

        <div
            class="col-span-1 md:col-start-4 md:col-span-3 lg:col-span-8 lg:col-start-5  
                 border-sgaDarkBlue border-2 border-dashed">

            @if ($isGenerated == 1)
                <x-pdf-view reportRoute="/generate/stored-report" referenceNumber="{{ $referenceNumber }}" button="false"
                    {{-- wire:click="storeLog()" wire:confirm="Are you sure you want to save this report?"  --}}>

                    <div class="flex flex-row">
                        <div class="mt-4 ml-4">
                            <x-red-button label="Cancel" />
                        </div>
                        <div class="mt-4 ml-4">
                            <x-create-button label="Save" />
                        </div>
                    </div>

                </x-pdf-view>
            @else
                <div class="flex justify-center">
                    <h2 class="text-stone-700 text-2xl font-semibold mt-10">Generated report will be shown here!</h2>
                </div>
            @endif

        </div>

    </div>

</x-view-main-content-v2>
