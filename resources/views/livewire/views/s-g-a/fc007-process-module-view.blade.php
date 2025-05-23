<x-view-main-content-v2 pageTitle="{{ $title }}">

    <x-result-message />

    <div class="grid grid-cols-1 gap-6" x-data="{ sendBackModal: false, sendPaymentSlipModal: false }">
        
        @if ($isGenerated == 1)
            <div
                class="col-span-1 md:col-span-6 lg:col-span-12
                 border-sgaDarkBlue border-2 border-dashed">
                <x-pdf-view reportRoute="/generate/stored-report" referenceNumber="{{ $referenceNumber }}" button="false">

                    <div class="flex flex-row">

                        <div class="mt-4 ml-4">
                            <x-red-button label="{{$processId != 5 ? 'Cancel' : 'Close'}}" wire:click="cancel()" />
                        </div>
                        <div class="mt-4 ml-4">
                            
                                {{-- ------------------------------------------------- --}}
                                {{-- ------------------------------------------------- --}}
                                {{-- @if (!($processId == 4 || $processId == 5)) --}}
                                @if ($processId != 5)
                                    <x-create-button label="{{ $buttonLabel }}" wire:click="update()"
                                    wire:confirm="Are you sure you want to save?" />
                                @endif
                                    
                                {{-- @else
                                    <x-create-button label="{{ $buttonLabel }}" class="text-sm"
                                        x-on:click="sendPaymentSlipModal = true" />

                                    <div x-show="sendPaymentSlipModal">
                                        <x-modal title="Add Attachment">

                                            <x-form-section submit="storeAttachment" :file="true">
                                                <x-slot:form>
                                                    <div class="w-full">
                                                        <x-text-input name="description" title="Description"
                                                            type="text" wire:model="description" />
                                                    </div>
                                                    <div class="w-full">
                                                        <x-text-input name="file" title="Choose File" type="file"
                                                            wire:model="file" />
                                                    </div>
                                                </x-slot:form>
                                                <x-slot:actions>
                                                    <x-red-button label="close"
                                                        x-on:click="sendPaymentSlipModal=false" />
                                                    <x-submit-button label="save" />
                                                </x-slot:actions>
                                            </x-form-section>

                                        </x-modal>
                                    </div>
                                @endif --}}
                                {{-- ------------------------------------------------- --}}
                                {{-- ------------------------------------------------- --}}

                        </div>
                        {{-- temporary comment --}}
                        {{-- @if ($processId < 4)
                            <div class="w-full mt-4 ml-4 mr-4">
                                <x-create-button label="Send Back" class="float-end"
                                    x-on:click="sendBackModal = true" />
                            </div>
                        @endif --}}

                    </div>

                </x-pdf-view>
            </div>
        @else
            <div class="col-span-1  ">
                <livewire:components.logs.fc007-list-component statusId="{{ $processId }}" />
            </div>
        @endif



        {{-- sendback modal --}}
        {{-- temporary comment --}}
        {{-- <div x-show="sendBackModal">
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
        </div> --}}

    </div>
</x-view-main-content-v2>
