@props(['name', 'title'])
<label for="{{$name}}" class="text-stone-600 text-sm">Address</label>
<textarea name="{{ $name }}" id="{{ $name }}" {{ $attributes }}></textarea>
@error($name)
    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
        {{ $message }}
    </span>
@enderror
