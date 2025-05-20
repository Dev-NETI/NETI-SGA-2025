<section>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <x-result-message />

        <form wire:submit.prevent="verify">
            @csrf
            <div class="grid grid-cols-6 gap-2" x-data="{ focusIndex: 1 }">
                <div class="col-span-6">
                    {{-- <x-label value="Enter verification pin" /> --}}
                    <x-label value="Enter verification pin: {{ $verificationPin }}" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField1"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 2; 
                            $nextTick(() => { $refs.inputField2.focus(); });
                        }"
                        wire:model="input1" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField2"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 3; 
                            $nextTick(() => { $refs.inputField3.focus(); });
                        }"
                        wire:model="input2" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField3"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 4; 
                            $nextTick(() => { $refs.inputField4.focus(); });
                        }"
                        wire:model="input3" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField4"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 5; 
                            $nextTick(() => { $refs.inputField5.focus(); });
                        }"
                        wire:model="input4" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField5"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 6; 
                            $nextTick(() => { $refs.inputField6.focus(); });
                        }"
                        wire:model="input5" />
                </div>
                <div class="col-span-1">
                    <x-input class="w-14 text-center" x-ref="inputField6"
                        x-on:keydown="
                        if($event.key.length === 1) { 
                            focusIndex = 6; 
                            $refs.inputField6.focus(); 
                        }"
                        wire:model="input6" />
                </div>
                <div class="col-span-6 flex justify-start">
                    <div>
                        <x-label value="Didn't get the verification pin? click here to resend" class="text-sm hover:text-red-900"
                            x-on:click="$wire.sendVerificationPin()" />
                    </div>
                </div>
                <div class="col-span-6 flex justify-end">
                    <div>
                        <x-submit-button label="Verify" />
                    </div>
                </div>
            </div>
        </form>

    </x-authentication-card>

</section>
