<aside id="logo-sidebar" x-data="{ bgColor: 'bg-sgaBlue', title:'NETI-SGA', fontColor:'text-sgaFontBlue' }" x-bind:class="bgColor"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full 
    bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div x-bind:class="bgColor" class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

        <div class="flex flex-row border-2 border-sgaBlue bg-sgaBlue my-2 rounded-lg shadow-lg shadow-sgaDarkerBlue">
            <span x-text="title" x-bind:class="fontColor"
            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap mx-auto"></span>
        </div>

        <ul class="space-y-2 font-medium">
            {{ $slot }}
        </ul>
    </div>
</aside>
