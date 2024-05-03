<x-main-content pageTitle="{{ $hash != null ? 'Update User' : 'Create User' }}">

    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}"
        enctype="multipart/form-data">
        @csrf

        @if ($pwId == null)
            <x-text-input name="firstname" title="Firstname" wire:model="firstname" type="text" />

            <x-text-input name="middlename" title="Middlename" wire:model="middlename" type="text" />

            <x-text-input name="lastname" title="Lastname" wire:model="lastname" type="text" />

            <x-text-input name="email" title="Email" wire:model="email" type="email" />

            <x-select-input name="principal" title="Principal" :data="$principalData" :hash="$hash"
                wire:model.live="principal" />

            <x-select-input name="company" title="Company" :data="$companyData" :hash="$hash"
                wire:model.live="company" />

            <x-dependent-select-input wire:model="department" :data="$departmentData" :hash="$hash" name="department"
                title="Department" />

            <x-select-input name="position" title="Position" :data="$positionData" :hash="$hash"
                wire:model="position" />

            <x-text-input name="signature" title="Upload signature" wire:model="signature" type="file" />

        @endif

        @if ($hash == null || ($hash != null && $pwId == 1))
            <div class="relative z-0 w-full mb-5 group grid grid-cols-1">
                <div class="flex">
                    <input type="password" name="Password" id="Password" wire:model="password"
                        onmouseover="this.type='text'" onmouseout="this.type='password'"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                focus:border-blue-600 peer"
                        placeholder=" " value="" />
                    <label for="Password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                peer-focus:-translate-y-6">Password</label>
                    <button type="button" title="Generate Password" wire:click="generatePassword()"
                        class="text-gray-900 border border-gray-900 hover:bg-gray-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <livewire:components.reusable.error-span-red message="{{ $message }}" />
                @enderror
            </div>
        @endif

        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>

</x-main-content>
