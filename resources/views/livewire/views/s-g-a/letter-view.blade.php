<x-view-main-content-v2 pageTitle="{{ $title }}">

    <div class="sm:col-span-1 md:col-span-3 lg:col-span-6">

        <div class="md:flex mt-8">

            <x-tab-content title="{{ $contentTitle }}">
                <livewire:components.s-g-a.generate-letter-component />
            </x-tab-content>

        </div>
        
    </div>
    
</x-view-main-content-v2>
