<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2-2">

    <div class="container-sm">
        <div class="bx">
            <h2>Real-Time Saving</h2>
            <livewire:real-time-saving-with-form-object />
        </div>
    </div>

    <div class="container-md">
        <div class="bx">
            <h2>DataTable with Create Edit Modal</h2>
            <p>Manage the create edit through events or include on the table component?</p>
            <livewire:data-table-with-create-edit-modal />
            <div class="bx mt">
                <code>$course = \App\Models\Course::first();</code>
                <?php $course = \App\Models\Course::first(); ?>
                <livewire:create-edit-with-form-object :$course />
            </div>
            <div class="bx mt">
                <code>$course = \App\Models\Course::find(3);</code>
                <?php $course = \App\Models\Course::find(3); ?>
                <livewire:create-edit-with-form-object :course="$course->id" />
            </div>
            <div class="bx mt">
                <livewire:create-edit-with-form-object />
            </div>
        </div>
    </div>

</x-gotime-app-layout>
