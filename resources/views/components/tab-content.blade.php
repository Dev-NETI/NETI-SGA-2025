@props(['title'])
<div class="p-6 bg-gray-100 hover:bg-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
    <x-header-5 title="{{$title}}" />
    {{$slot}}
</div>
