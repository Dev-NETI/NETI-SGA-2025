@props(['pageTitle'])
<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 bg-sgaBlue border-2 border-sgaBlue shadow-lg shadow-sgaDarkBlue hover:border-sgaDarkerBlue rounded-lg ">

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4  rounded bg-sgaBlue">
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
