@props(['name','title'])

<label for="message" class="block mb-2 text-sm font-medium text-sgaFontBlue dark:text-white">{{$title}}</label>
<textarea id="message" rows="4" {{$attributes}}
    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-sgaDarkBlue focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    placeholder=""></textarea>
@error($name)
    <span
        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                        dark:bg-red-900 dark:text-red-300">
        {{ $message }}
    </span>
@enderror
