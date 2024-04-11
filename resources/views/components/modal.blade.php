@props(['title'])
<div id="crypto-modal" tabindex="-1" aria-hidden="true" {{$attributes}}
    class="overflow-y-auto overflow-x-auto fixed top-0 right-0 bottom-0 left-0 z-50 flex justify-center items-center">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-sgaDarkBlue rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-3xl font-semibold text-sgaBlue dark:text-white">
                    {{$title}}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
