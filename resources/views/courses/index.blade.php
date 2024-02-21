<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="flex gap container py-2">
    <x-layouts.split>
        <x-slot name="laravel">
            <h3>Laravel Controller (index)</h3>
            <div class="flex-col">
                @forelse($courses as $course)
                    <div class="flex space-between">
                        <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                        <div class="flex">
                            <a href="{{ route('courses.edit', $course->id) }}" class="disabled">
                                <x-gt-icon name="pencil-square" class="txt-sky opacity-06" /></a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <x-gt-icon name="trash" class="txt-rose opacity-06" />
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="fw7">
                        <p>Nothing to see here!</p>
                    </div>
                @endforelse
            </div>
            {{ $courses->links('pagination.jtb-simple') }}
        </x-slot>

        <x-slot name="livewire">
            <h3>Livewire Data Table</h3>
            <livewire:course.table />
        </x-slot>
    </x-layouts.split>
</x-gotime-app-layout>
