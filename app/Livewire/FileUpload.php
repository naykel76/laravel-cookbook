<?php

namespace App\Livewire;

use App\Models\Course;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Naykel\Gotime\Facades\FileManagement;

class FileUpload extends Component
{
    use WithFileUploads;

    public Course $course;
    protected string $disk = 'public';
    protected string $directory = 'courses';
    public $tmpUpload;

    public function mount()
    {
        $this->course = Course::first();
    }

    public function save()
    {
        $validated = $this->validate([
            'tmpUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->handleFile($this->tmpUpload, $validated);

        // Remove the tmpUpload from the validated data
        unset($validated['tmpUpload']);

        $this->course->update($validated);

        return redirect()->route('file-uploads.edit')
            ->with('notification', 'Save successful!');
    }


    // this code is duplicated in the `FileUploadsController` and
    // should be refactored into a service class
    private function handleFile(UploadedFile $file, array &$validated)
    {
        if ($file) {
            $path = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated['image'] = $path;
        }
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <x-errors />
                <form wire:submit.prevent="save">
                    <x-gt-file-input wire:model="tmpUpload" for="tmpUpload" default/>
                    <div class="tar">
                        <x-gt-submit class="primary" />
                    </div>
                </form>
            </div>
        HTML;
    }
}
