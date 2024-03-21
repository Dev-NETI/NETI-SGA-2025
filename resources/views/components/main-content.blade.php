@props(['pageTitle'])
<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 border-2 border-gray-200 hover:border-gray-400 border-dashed rounded-lg dark:border-gray-700">

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4  rounded bg-gray-50 dark:bg-gray-800">
            <div class="md:col-span-1 lg:col-span-3">
                <x-header-5 :title="$pageTitle" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6">
            <div class="md:col-start-2 lg:col-start-3 lg:col-span-2">
                {{$slot}}
            </div>
        </div>

    </div>
</div>
