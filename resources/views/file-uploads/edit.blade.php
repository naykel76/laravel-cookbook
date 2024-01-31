<x-gotime-app-layout layout="{{ config('naykel.template') }}" :pageTitle class="flex gap container py-2">
    <div class="w-20 txt-sm">
        <div class="bx pxy-1 tac bg-sky-200">
            <p>Don't forget to include 'enctype' in your form tag <code>enctype="multipart/form-data"</code>.</p>
        </div>
        <div class="bx dark tac">
            <p>Errors do not play well here because both components have the same input names. Just run with it!</p>
        </div>
        <x-notification />
    </div>
    <x-layouts.split>
        <x-slot name="laravel">
            <h3>Laravel File Upload</h3>
            <x-errors />
            <form action="{{ route('file-uploads.update', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-gt-file-input for="image" default />
                <div class="tar">
                    <x-gt-submit class="primary" />
                </div>
            </form>
        </x-slot>
        <x-slot name="livewire">
            <h3>Livewire File Upload</h3>
            <livewire:file-upload />
        </x-slot>
    </x-layouts.split>

    <div class="w-14 self-start">
        <div class="bx tac">
            <h6 class="m">Default Image</h6>
            <img src="{{ asset('storage/' . $course->image) }}" alt="Laravel image" class="mt-05">
        </div>
    </div>
</x-gotime-app-layout>
