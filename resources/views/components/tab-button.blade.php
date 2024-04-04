@props(['label','icon','active','route'])
<li>
    <a href="{{route($route)}}"
        class="{{$active ? 'bg-blue-700':'bg-stone-500'}}  inline-flex items-center px-1.5 py-1.5 text-white 
        hover:bg-stone-900 rounded-lg w-full dark:bg-blue-600 text-[.65rem]"
        aria-current="page">
        {{$label}}
    </a>
</li>
