<div class="frm-row">
    <input type="file" class="filepond-input w-full" style="display: none;">
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
    <script>
        const inputElement = document.querySelector('.filepond-input');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                process: '/cookbook/file-uploads/tmp-upload',
                revert: '/cookbook/file-uploads/tmp-delete',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });

    </script>
@endPushOnce
