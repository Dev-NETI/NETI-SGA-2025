<x-main-content pageTitle="{{ $hash != null ? 'Update Department' : 'Create Department' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">
        @csrf
        <x-text-input name="department" title="Department" wire:model="department" type="text" />
        <x-select-input name="company" title="Company" wire:model="company" :data="$companyData" :hash="$hash" />
        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>
