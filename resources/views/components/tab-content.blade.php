@props(['title'])
<div class="p-6 bg-sgaBlue text-medium text-sgaFontBlue rounded-lg w-full shadow-lg shadow-sgaDarkerBlue">
    <x-header-5 title="{{$title}}" />
    {{$slot}}
</div>
