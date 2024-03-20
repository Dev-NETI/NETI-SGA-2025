<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 border-2 border-gray-200 hover:border-gray-400 border-dashed rounded-lg dark:border-gray-700">

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4  rounded bg-gray-50 dark:bg-gray-800">
            <div class="md:col-span-1 lg:col-span-3">
                <livewire:components.reusable.header5
                    title="{{ $hash != null ? 'Update Company' : 'Create Company' }}" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6">
            <div class="md:col-start-2 lg:col-start-3 lg:col-span-2">
                <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="floating_email" id="floating_email" wire:model.blur="name"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                            appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                            focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                            origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                            peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                            peer-focus:-translate-y-6">
                            Company
                        </label>
                        @error('name')
                            <livewire:components.reusable.error-span-red message="{{ $message }}" />
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="floating_email" id="floating_email" wire:model.blur="code"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                            appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                            focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                            origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                            peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                            peer-focus:-translate-y-6">
                            Code
                        </label>
                        @error('code')
                            <livewire:components.reusable.error-span-red message="{{ $message }}" />
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <livewire:components.reusable.submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
