<x-view-main-content pageTitle="{{ $title ?? 'Page Title' }}">

    <x-result-message />

    <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-8 gap-8 mt-6">
        <div class="col-span-1 md:col-span-3 lg:col-span-4">
            <livewire:components.user.role-list-component :user="$userId" :hash="$hash" />
        </div>
        <div class="col-span-1 md:col-span-3 md:col-start-4 lg:col-span-4 lg:col-start-5">
            <livewire:components.user.user-role-list-component :user="$userId" :hash="$hash" />
        </div>
    </div>

</x-view-main-content>