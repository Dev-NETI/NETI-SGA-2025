@props(['label', 'type' => 'a'])
<li>
    @if ($type === 'button')
        <button {{ $attributes }} class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            {{ $label }}
        </button>
    @else
        <a {{ $attributes }} class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            {{ $label }}
        </a>
    @endif
</li>
