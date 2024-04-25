@props(['cardTitle', 'cardDescription', 'dataCount','route'=>'sga.tFee-index'])

<section>
    <div
        class="flex flex-col items-center  border border-sgaDarkerBlue rounded-lg 
    shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700  
    transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 h-[11rem]">

        <div class="w-full rounded-t-lg  md:h-auto md:w-48 md:rounded-none md:rounded-s-lg">
            <h2 class="font-bold text-center text-4xl">{{ $dataCount }}</h2>
        </div>

        <div class="flex flex-col justify-between p-4 leading-normal bg-sgaDarkerBlue h-full w-full">

            <div x-data="{ tooltip: false }" {{ $attributes }}>
                <svg class="w-6 h-6 text-gray-800 hover:text-sgaBlue dark:text-white float-end" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24" x-on:mouseenter="tooltip = true" x-on:mouseleave="tooltip = false">
                    <path fill-rule="evenodd"
                        d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                        clip-rule="evenodd" />
                </svg>
                <x-tooltip x-show="tooltip" class="float-end">
                    Maintenance
                </x-tooltip>
            </div>
            

            <a href="{{ route($route) }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-stone-300 dark:text-white">{{ $cardTitle }}
                </h5>
            </a>
            <p class="mb-3 font-normal text-sgaBlue dark:text-gray-400">{{ $cardDescription }}</p>

        </div>

    </div>
</section>
