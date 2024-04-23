@props(['name', 'email', 'modified', 'timestamp'])
<li class="pb-3 sm:pb-4 text-sgaFontBlue hover:bg-sgaDarkerBlue hover:text-sgaBlue">

    <div class="flex items-center space-x-4 rtl:space-x-reverse ">

        <div class="flex-1 min-w-0">
            <p class="ml-1 text-md font-medium  truncate dark:text-white mt-1">
                {{ $name }}
            </p>
            <p class="ml-1 text-sm truncate dark:text-gray-400">
                {{ $email }}
            </p>
            <p class="ml-1 text-xs truncate dark:text-gray-400 mt-1">
                Modified By:{{ $modified }}
            </p>
            <p class="ml-1 text-xs truncate dark:text-gray-400 mt-1">
                {{ $timestamp }}
            </p>
        </div>
        <div class="inline-flex items-center text-base font-semibold  dark:text-white">
            {{ $slot }}
        </div>

    </div>

</li>
