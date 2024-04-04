<x-sga-container pageTitle="{{ $title }}">

    <div class="md:flex mt-8">

        <ul
            class="flex-column space-y space-y-4 text-sm font-medium 
        text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">

            <x-tab-button route="sga.letter-index" :active="false" label="Summary" />
            <x-tab-button route="sga.tFee-index" :active="true" label="FC-007" />

        </ul>

        <x-tab-content title="{{ $contentTitle }}">
            <livewire:components.s-g-a.generate-training-fee-component />
        </x-tab-content>

    </div>

</x-sga-container>
