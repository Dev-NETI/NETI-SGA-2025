<x-sga-container pageTitle="{{ $title }}">

    <div class="md:flex mt-8">

        <ul
            class="flex-column space-y space-y-4 text-sm font-medium 
        text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">

            <x-tab-button route="sga.letter-index" :active="false" label="Letter for Principal"
                icon="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
            <x-tab-button route="sga.tFee-index" :active="true" label="Training Fee"
                icon="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />

        </ul>

        <x-tab-content title="{{ $contentTitle }}">
            <livewire:components.s-g-a.generate-training-fee-component />
        </x-tab-content>

    </div>

</x-sga-container>
