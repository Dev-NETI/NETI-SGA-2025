<x-main-content pageTitle="{{ $hash != null ? 'Update Company' : 'Create Company' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">
        @csrf
        <x-text-input name="name" title="Name" wire:model="name" type="text" />
        <x-text-input name="code" title="Code" wire:model="code" type="text" />
        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>