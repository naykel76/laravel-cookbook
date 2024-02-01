<x-gotime-app-layout layout="{{ config('naykel.template') }}" :pageTitle class="flex gap container py-2">
    <x-layouts.split>
        <x-slot name="laravel">
            <h3>Laravel</h3>
            @include('courses.create-edit-form', ['course' => $course])
            <x-notification />
        </x-slot>
    </x-layouts.split>

    <div class="w-14 fs0 self-start">
        <h6>Default Image</h6>
        <div class="bx pxy-075 tac mt-025">
            <img src="{{ asset('storage/' . $course->image) }}" alt="Laravel image" class="mt-05">
        </div>
    </div>
</x-gotime-app-layout>
