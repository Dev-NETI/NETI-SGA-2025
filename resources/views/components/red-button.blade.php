@props(['label'])
<button type="button" {{ $attributes->merge(['class'=>'text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 mb-4
    rounded-md font-medium px-5 py-2 text-center 
    transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-gradient-to-tr 
    hover:from-red-700 hover:to-red-900 duration-300']) }}
>
    {{ $label }}
</button>
