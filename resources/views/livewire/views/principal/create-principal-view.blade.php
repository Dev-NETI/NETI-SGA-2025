<x-main-content pageTitle="{{ $hash != null ? 'Update Principal' : 'Create Principal' }}">
    <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">

        <x-text-input name="principal" title="Principal" wire:model="principal" type="text" />

        <div class="flex justify-end">
            <x-submit-button label="{{ $hash != null ? 'Update' : 'Create' }}" />
        </div>

    </form>
</x-main-content>
{{-- <link href="node_modules/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="node_modules/froala-editor/js/froala_editor.pkgd.min.js"></script> --}}
