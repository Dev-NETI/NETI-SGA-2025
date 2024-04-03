<x-main-content pageTitle="{{ $hash != null ? 'Update Principal' : 'Create Principal' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">
        @csrf
        <x-text-input name="principal" title="Principal" wire:model="principal" type="text" />
        {{-- <x-custom-textarea name="address" title="Address" wire:model="address" /> --}}
        <x-text-area name="address" title="Address" wire:model="address" />
        <div class="flex justify-end mt-2">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>

    {{-- <script>
        tinymce.init({
                selector: '#address'
            });
    </script> --}}
</x-main-content>
