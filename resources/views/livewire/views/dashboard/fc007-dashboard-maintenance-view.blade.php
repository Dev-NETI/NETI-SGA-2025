<x-view-main-content-v2 pageTitle="{{ $title }}">

    <x-result-message />

    <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-12">

        <div class="col-span-1 md:col-start-3 md:col-span-5 lg:col-start-4 lg:col-span-6 mt-3" x-data="{ modal: false }">

            <x-create-button label="Add" class="float-end" x-on:click="modal = true" />

            <div x-show="modal" x-cloak x-transition>
                <x-modal title="Add recipient">

                    <form id="formEmail" wire:submit.prevent="store">
                        @csrf
                        <x-select-input name="user" title="Select user" :data="$userData" :hash="null"
                            wire:model="user" />
                    </form>

                    <div class="flex flex-row gap-2 justify-end">
                        <x-red-button label="Cancel" x-on:click="modal = false" />
                        <x-submit-button label="Save" form="formEmail" />
                    </div>

                </x-modal>
            </div>

        </div>

        <div class="col-span-1 md:col-start-3 md:col-span-5 lg:col-start-4 lg:col-span-6 mt-3 ">
            <livewire:components.sga-dashboard.fc007-dashboard-maintenance-list-component
                processId="{{ $processId }}" />
        </div>

    </div>

</x-view-main-content-v2>
