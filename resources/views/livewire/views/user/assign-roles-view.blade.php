<div class="grid grid-cols-1">
    <div class="flex justify-center items-center">

        <a href="#"
            class="card-layout mt-10 block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 
                   dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title ?? 'Page Title' }}
            </h5>
            
            <x-result-message />
            <div class="grid grid-cols-3 mt-6">
                <livewire:components.user.list-component :user="$userId" :data="$roleData" isRole="1" /> 
                <div class="flex"></div>
                <livewire:components.user.list-component :user="$userId" :data="$userRoleData" isRole="2" /> 
            </div>
            
        </a>

    </div>
</div>
