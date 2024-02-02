<x-gotime-app-layout layout="{{ config('naykel.template') }}" :pageTitle class="flex gap container py-2 check-off-table">
    <div class="w-20 fs0 txt-sm">
        <div class="bx pxy-1 tac bg-sky-200">
            <p>Make sure to include 'enctype' in your form tag <code>enctype="multipart/form-data"</code>.</p>
        </div>

        <x-gt-parsedown path="{{ 'pages/form-checklist' }}" />
    </div>

    <x-layouts.stacked>
        <x-slot name="laravel">
            <h3>Laravel</h3>
            @include('courses.create-edit-form', ['course' => $course])
            <x-notification />
        </x-slot>
        <x-slot name="livewire">
            <h3>Livewire</h3>
            <livewire:course.create-edit />
        </x-slot>
    </x-layouts.stacked>

    <div class="w-20 fs0 self-start">
        <h6>Default Image</h6>
        <div class="bx pxy-075 tac mt-025">
            <img src="{{ asset('storage/' . $course->image) }}" alt="Laravel image" class="mt-05">
        </div>
        <ul class="txt-red txt-sm">
            <li>The Laravel price is not formatting correctly.</li>
        </ul>
    </div>
</x-gotime-app-layout>
