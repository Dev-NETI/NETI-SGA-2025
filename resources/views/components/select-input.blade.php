@props(['name', 'title', 'data', 'hash'])
<div class="relative z-0 w-full mb-5 group">

    @if ($data != null)

        <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-sgaDarkBlue 
                appearance-none focus:outline-none focus:ring-0 
                focus:border-sgaDarkerBlue peer"
            placeholder=" ">
            @if ($hash == null)
                <option value="">Select</option>
            @endif
            @foreach ($data as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>

        <label for="{{ $name }}"
            class="peer-focus:font-medium absolute text-sm text-sgaFontBlue  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-sgaDarkerBlue 
                 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                peer-focus:-translate-y-6">
            {{ $title }}
        </label>

        @error($name)
            <span
                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded  ">
                {{ $message }}
            </span>
        @enderror
    @else
           
    @endif


</div>
