@props(['title'])
<li class="w-full px-4 py-2 border-b text-sgaFontBlue text-lg border-gray-200 dark:border-gray-600 
hover:bg-sgaDarkerBlue hover:text-sgaBlue">
    
    <div class="flex flex-row  justify-between">
        <div class="my-auto">
            {{ $title }}
        </div>
        <div class="my-auto">
            {{ $slot }}
        </div>
    </div>


</li>
