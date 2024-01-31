<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="flex gap container py-2">

    <div id="laravel-index-table" class="fg1 bx bg-yellow-50 self-start">
        <h3>Laravel Controller (index)</h3>
        <div class="flex-col">
            @forelse($courses as $course)
                <div class="flex space-between">
                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                    <div>
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
                </div>
            @empty
                <div class="fw7">
                    <p>Nothing to see here!</p>
                </div>
            @endforelse
        </div>
        {{ $courses->links('pagination.jtb-simple') }}
    </div>

    <div id="livewire-data-table" class="fg1 bx bg-sky-50 self-start">
        <h3>Livewire Data Table</h3>
        <livewire:course.table />
    </div>
</x-gotime-app-layout>
