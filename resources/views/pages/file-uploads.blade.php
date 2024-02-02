<x-gotime-app-layout layout="{{ config('naykel.template') }}" :pageTitle
    class="flex gap container py-2">
    <div class="w-20 fs0 txt-sm">
        <div class="bx pxy-1 tac bg-sky-200">
            <p>Make sure to include 'enctype' in your form tag <code>enctype="multipart/form-data"</code>.</p>
        </div>
        <div class="bx dark tac">
            <p>Errors do not play well here because both components have the same input names. <br>It's only for testing
                so just run with it!</p>
        </div>
        <div class="bx tac">
            FilePond validation for the file size is hard coded in the component.
        </div>
        <x-errors />
        <x-notification />
    </div>

    <x-layouts.split>
        <x-slot name="laravel">
            <h3>Laravel File Upload</h3>
            <form action="{{ route('file-uploads.update', $course) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-gt-file-input for="image" default />
                <x-laravel.filepond for="image_filepond" />
                <div class="tar">
                    <x-gt-submit class="primary" />
                </div>
            </form>
        </x-slot>

        <x-slot name="livewire">
            <h3>Livewire File Upload</h3>
            <livewire:file-upload />
        </x-slot>


        @include('diagrams.filepond-tmp-upload-flowchart')
        @include('diagrams.livewire-file-upload-sequence-diagram')

    </x-layouts.split>

    <div class="w-14 fs0 self-start">
        <h6>Default Image</h6>
        <div class="bx pxy-075 tac mt-025">
            <img src="{{ asset('storage/' . $course->image) }}" alt="Laravel image"
                class="mt-05">
        </div>
        <h6>Filepond Image</h6>
        <div class="bx pxy-075 tac mt-025">
            <img src="{{ asset('storage/' . $course->image_filepond) }}" alt="Laravel image"
                class="mt-05">
        </div>
    </div>
</x-gotime-app-layout>
