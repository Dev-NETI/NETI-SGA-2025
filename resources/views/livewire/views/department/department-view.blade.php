<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 border-2 border-gray-200 hover:border-gray-400 border-dashed rounded-lg dark:border-gray-700">

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4  rounded bg-gray-50 dark:bg-gray-800">
            <div class="sm:col-span-1 md:col-span-2 lg:col-span-3">
                <livewire:components.reusable.header5 :title="$title" />
            </div>
            <div class="sm:col-span-1 md:col-start-4 lg:col-start-6 justify-end">
                <livewire:components.reusable.create-button label="Create" routeName="company.create" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
            <x-result-message />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
            {{-- <livewire:components.company.company-list-component /> --}}
        </div>

    </div>
</div>
