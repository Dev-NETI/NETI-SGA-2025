@props(['label','route'])
<li>
    <a href="{{ route($route) }}"
        class="flex items-center p-2 group " {{$attributes}}>
        {{$slot}}
        <span class="ms-3">{{$label}}</span>
    </a>
</li>
