{{-- @this gives you access to the livewire component. @this.set.title = 'My Title' --}}
@props(['for' => null, 'label' => null])

<div x-data wire:ignore
    x-init="
        FilePond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            },
        });

        FilePond.create($refs.input);
    "
    class="frm-row">
    <label>{{ $label }}</label>
    <input type="file" x-ref="input">

    @error($for)
        <small class="txt-red" role="alert"> {{ $message }} </small>
    @enderror
</div>


@push('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <style>
        .filepond--root {
            margin-bottom: 0;
        }

        .filepond--credits {
            display: none;
        }

    </style>
@endpush

@pushOnce('scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endPushOnce

