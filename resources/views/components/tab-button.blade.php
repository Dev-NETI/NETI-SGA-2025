@props(['label','icon','active','route'])
<li>
    <a href="{{route($route)}}"
        class="{{$active ? 'bg-sgaDarkerBlue text-sgaBlue':'bg-sgaBlue text-sgaFontBlue border-2 border-stone-200'}}  
        inline-flex items-center px-1.5 py-1.5 hover:bg-sgaDarkerBlue hover:text-sgaBlue rounded-lg w-full text-[.65rem]"
        aria-current="page">
        {{$label}}
    </a>
</li>
