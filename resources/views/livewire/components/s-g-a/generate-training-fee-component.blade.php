<div class="grid grid-cols-1 mt-8 gap-6">

    @if ($rejectedList)
        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------- --}}
        <div
            class="sm:col-span-1 md:col-span-5 lg:col-span-9 md:-mt-4 lg:-mt-4
                 border-sgaDarkBlue border-2 border-dashed ">

            <div class="flex flex-row gap-4">
                <x-red-button label="Cancel" wire:click="cancelRejectedList" class="ml-4 mt-4" />
            </div>
            <livewire:components.s-g-a.rejected-training-report-list-component :vessel="$vesselTypeData" />

        </div>
        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------- --}}
    @else
        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------- --}}
        @if ($isGenerated)
            <div
                class="h-[52rem] sm:col-span-1 md:col-span-5 lg:col-span-9 md:-mt-4 lg:-mt-4
         border-sgaDarkBlue border-2 border-dashed ">
                <div class="flex flex-col">
                    <x-pdf-view reportRoute="/generate/training-fee" referenceNumber="{{ $referenceNumber }}"
                        :button="false">
                        <div class="flex flex-row gap-4 justify-start">
                            <x-red-button label="Cancel" wire:click="cancel()" />
                            <x-create-button label="Send for verification" wire:click="storeLog({{ $reGenerate }})"
                                wire:confirm="Are you sure you want to save this report?" />
                        </div>
                    </x-pdf-view>
                </div>
            </div>
        @else
            @if ($sentBackBoardCount > 0)
                <div class="flex justify-end mb-4">
                    <x-red-button label="View rejected reports" wire:click="showRejected()" />
                </div>
            @endif

            <div class="flex justify-center px-20">
                <form class="w-full max-w-2xl" wire:submit.prevent="generate">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-text-input name="month" title="Select month" wire:model="month" type="month" />
                        </div>
                        <div>
                            <x-select-input name="principal" title="Select principal" wire:model="principal" :data="$principalData"
                                :hash="$hash" />
                        </div>
                        {{-- <div>
                            <x-select-input name="vesselType" title="Select vessel type" wire:model="vesselType"
                                :data="$vesselTypeData" :hash="$hash" />
                        </div> --}}
                        <div>
                            <x-submit-button label="Generate" />
                        </div>
                    </div>
                </form>
            </div>
        @endif
        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------- --}}
    @endif

</div>
