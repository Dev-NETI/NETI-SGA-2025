<tr class="border-b border-gray-200 dark:border-gray-700" x-data="{ attachmentModal: false }">
    <x-td>
        <p class="font-bold">Reference #: {{ $data->reference_number }}</p>
        {!! $data->audit_log !!}
    </x-td>
    <td class="flex flex-row justify-center">

        <x-action-dropdown :id="$data->id" class="mt-8">

            <x-action-dropdown-item label="View" type="button" wire:click="show()" />

            <div x-data="{ attachment: false }">

                <x-action-dropdown-item label="View Attachments" type="button"
                    wire:click="showAttachment({{ $data->id }})" x-on:click="attachment=true" />
                <div x-show="attachment">
                    <x-modal title="View Attachment">
                        @if ($attachmentData !== null)
                            <x-ul-search :data="$attachmentData" :pagination="false" :searchable="false">

                                @foreach ($attachmentData as $item)
                                    <x-ul-item :title="$item->description">
                                        <x-anchor label="View" link="{{ asset('storage/F-FC-007-Attachments/'.$item->filepath) }}" />
                                    </x-ul-item>
                                @endforeach
                                <div class="flex flex-row justify-end">
                                    <x-red-button label="close" x-on:click="attachment=false" />
                                </div>
                            </x-ul-search>
                        @endif
                    </x-modal>
                </div>

            </div>

            <div x-data="{ modal: false }">

                <x-action-dropdown-item label="Add Attachment" type="button" x-on:click="modal=true" />
                <div x-show="modal">
                    <x-modal title="Add Attachment">

                        <x-form-section submit="storeAttachment" :file="true">
                            <x-slot:form>
                                <div class="w-full">
                                    <x-select-input wire:model="attachmentType" name="attachmentType"
                                        title="Select Attachment Type" :data="$attachmentTypeData" :hash="null" />
                                </div>
                                <div class="w-full">
                                    <x-text-input name="description" title="Description" type="text"
                                        wire:model="description" />
                                </div>
                                <div class="w-full">
                                    <x-text-input name="file" title="Choose File" type="file" wire:model="file" />
                                </div>
                            </x-slot:form>
                            <x-slot:actions>
                                <x-red-button label="close" x-on:click="modal=false" />
                                <x-submit-button label="save" />
                            </x-slot:actions>
                        </x-form-section>

                    </x-modal>
                </div>

            </div>

        </x-action-dropdown>

    </td>
</tr>
