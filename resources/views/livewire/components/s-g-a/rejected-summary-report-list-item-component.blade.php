<tr class="border-b border-gray-200 dark:border-gray-700">
    <x-td class="w-4/12">
        <p class="font-bold">Reference #: {{ $data->reference_number }}</p>
        <p class="text-xs mt-1 font-semi">Rejected By: {{ $data->send_back_by }}</p>
        <p class="text-xs mt-1 font-semi">Rejected At: {{ $data->send_back_at }}</p>
    </x-td>
    <x-td class="w-4/12">
        {{ $data->send_back_details }}
    </x-td>
    <x-td class="w-4/12">

        {{-- ---------------------------------------------------------------------------- --}}
        <div x-data="{ reGenerateModal: false }">
            <x-create-button label="Generate" x-on:click="reGenerateModal = true" />

            <div x-show="reGenerateModal">
                <x-modal title="Generate Report">
                    <x-form-section submit="reGenerate">
                        <x-slot:form>
                            <div>
                                <x-text-input name="month" title="Select month" wire:model="month" type="month" />
                            </div>
                            <div>
                                <x-select-input name="principal" title="Select Principal" wire:model="principal"
                                    :data="$principalData" :hash="$hash" />
                            </div>
                        </x-slot:form>

                        <x-slot:actions>
                            <div class="flex flex-row justify-end gap-4">
                                <x-red-button label="Cancel" x-on:click="reGenerateModal = false" />
                                <x-submit-button label="Generate" />
                            </div>
                        </x-slot:actions>
                    </x-form-section>
                </x-modal>
            </div>

        </div>
        {{-- ---------------------------------------------------------------------------- --}}

    </x-td>
</tr>
