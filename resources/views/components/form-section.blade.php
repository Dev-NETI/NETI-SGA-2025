@props(['submit','file' => false])

<div {{ $attributes }}>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}" @if ($file)
            enctype="multipart/form-data"
        @endif >
            @csrf
            <div class="px-4 py-5 bg-sgaBlue sm:p-6 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="flex flex-col gap-2">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 bg-sgaBlue text-end sm:px-6 sm:rounded-bl-md sm:rounded-br-md gap-4 mt-4">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
