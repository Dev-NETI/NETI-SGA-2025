@props(['id','icon','title'])
<button type="button"
    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
    aria-controls="dropdown-example" data-collapse-toggle="dropdown-{{$id}}">
    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path
            d="{{$icon}}" />
    </svg>
    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{$title}}</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="m1 1 4 4 4-4" />
    </svg>
</button>
<ul id="dropdown-{{$id}}" class="hidden py-2 space-y-2">
    {{$slot}}
</ul>