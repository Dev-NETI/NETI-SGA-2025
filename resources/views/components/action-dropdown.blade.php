@props(['id'])

<div x-data="{ open: false }" {{ $attributes->merge(['class'=>'']) }}>
    <button x-on:click="open = ! open"
        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 
        rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        ...
    </button>

    <div x-show="open" @click.outside="open = false"
        class="bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            {{ $slot }}
        </ul>
    </div>
</div>