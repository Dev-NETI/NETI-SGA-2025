<x-view-main-content-v2 pageTitle="{{ $title }}">

    <x-result-message />

    <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-6" x-data="{ sendBackModal: false }">

        <div class="col-span-1 md:col-span-3 lg:col-span-4">
            <livewire:components.logs.fc007-list-component statusId="{{ $processId }}" />
        </div>

        <div
            class="col-span-1 md:col-start-4 md:col-span-3 lg:col-span-8 lg:col-start-5  
                 border-sgaDarkBlue border-2 border-dashed">

            @if ($isGenerated == 1)
                <x-pdf-view reportRoute="/generate/stored-report" referenceNumber="{{ $referenceNumber }}" button="false">

                    <div class="flex flex-row">
                        <div class="mt-4 ml-4">
                            <x-red-button label="Cancel" wire:click="cancel()" />
                        </div>
                        <div class="mt-4 ml-4">
                            <x-create-button label="Verify" wire:click="update()"
                                wire:confirm="Are you sure you want to verify and send to Comptroller?" />
                        </div>
                        <div class="w-full mt-4 ml-4 mr-4">
                            <x-create-button label="Send Back" class="float-end" x-on:click="sendBackModal = true" />
                        </div>
                    </div>

                </x-pdf-view>
            @else
                <div class="flex justify-center">
                    <h2 class="text-stone-700 text-2xl font-semibold mt-10">Generated report will be shown here!</h2>
                </div>
            @endif

        </div>

        {{-- sendback modal --}}
        <div x-show="sendBackModal">
            <x-modal title="Send Back">
                <x-form-section submit="updateSendBack">
                    <x-slot:form>
                        <x-text-area name="sendBackDetails" title="Reason" wire:model="sendBackDetails" />
                    </x-slot:form>
                    <x-slot:actions>
                        <x-red-button label="cancel" x-on:click="sendBackModal = false" />
                        <x-submit-button label="Send Back" />
                    </x-slot:actions>
                </x-form-section>
            </x-modal>
        </div>

    </div>
</x-view-main-content-v2>
