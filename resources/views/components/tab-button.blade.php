@props(['label','icon','active','route'])
<li>
    <a href="{{route($route)}}"
        class="{{$active ? 'bg-blue-700':'bg-stone-500'}}  inline-flex items-center px-4 py-3 text-white hover:bg-stone-900 rounded-lg w-full dark:bg-blue-600"
        aria-current="page">
        <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="{{$icon}}" />
        </svg>
        {{$label}}
    </a>
</li>
