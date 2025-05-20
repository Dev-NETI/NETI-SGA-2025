@props(['referenceNumber', 'reportRoute', 'button' => true])
<div class="flex flex-col">

    <div class="basis-full mt-4 ml-4">
        @if ($button === true)
            <x-create-button label="Save" {{ $attributes }} />
        @endif
        {{ $slot }}
    </div>

    <div class="basis-full mt-2 ml-4">
        <h6 class="font-bold text-sgaFontBlue">Reference Number: {{ $referenceNumber }}</h6>
    </div>
    <div class="basis-full">
        <iframe src="{{ env('APP_DOMAIN') . $reportRoute }}" frameborder="0" width="100%" class="h-[45rem]">
        </iframe>
        {{-- <iframe src="{{ env('APP_DOMAIN') . $reportRoute }}#toolbar=0" frameborder="0" width="100%" class="h-[45rem]">
        </iframe> --}}
    </div>

</div>
