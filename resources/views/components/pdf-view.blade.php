@props(['isGenerated','reportRoute'])
<div
    class="h-[50rem] sm:col-span-1 md:col-start-3 md:col-span-3 lg:col-start-4 lg:col-span-6 md:-mt-16 lg:-mt-16
         border-stone-400 border-2 border-dashed ">
    @if ($isGenerated == 0)
        <div class="flex justify-center">
            <h2 class="text-stone-700 text-2xl font-semibold mt-10">Generated report will be shown here!</h2>
        </div>
    @else
        <div class="flex flex-col">
            <div class="basis-full mt-4 ml-4">
                <x-create-button label="Save" />
            </div>
            <div class="basis-full">
                <iframe src="{{ $isGenerated == 1 ? env('APP_DOMAIN') . $reportRoute : '' }}" frameborder="0"
                    width="100%" class="h-[45rem]">
                </iframe>
            </div>
        </div>
    @endif
</div>
