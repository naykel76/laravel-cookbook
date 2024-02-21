<form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-gt-input for="title" label="Course Title" value="{{ $course->title }}" req />
    <div class="grid cols-3 gap">
        <x-gt-input for="code" label="code" value="{{ $course->code }}" req />
        <x-gt-input for="price" label="price" value="{{ $course->price }}" />
        <x-gt-select for="status" label="status" :options="\App\Models\Course::statuses()" disabled />
    </div>
    <div class="frm flex space-between va-b">
        <p class="txt-red txt-sm">**The Laravel price is not formatting the two decimal places correctly.</p>
        <x-gt-submit class="primary" />
    </div>
</form>
