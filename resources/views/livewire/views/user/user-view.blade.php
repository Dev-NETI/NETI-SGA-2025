<div class="grid grid-cols-1">
    <div class="flex justify-center items-center">

        <div href="#"
            class="card-layout mt-10 block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 
                   dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title ?? 'Page Title' }}
            </h5>
            
            <div class="flex justify-end">
                <button type="button" wire:click="create()"
                    class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br 
                focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg 
                dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 justify-end">Create</button>
            </div>
            
            <x-result-message />
            <livewire:components.user.user-list-component />
            
        </div>

    </div>
</div>
