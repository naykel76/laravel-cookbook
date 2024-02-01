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
    public $tmpUploadFilePond;

    public function mount()
    {
        $this->course = Course::first();
    }

    public function save()
    {
        $validated = $this->validate([
            'tmpUpload' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tmpUploadFilePond' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        $this->handleFile($this->tmpUpload, $validated);
        $this->handleFilePondFile($this->tmpUploadFilePond, $validated);

        // Remove the tmpUpload from the validated data
        unset($validated['tmpUpload'], $validated['tmpUploadFilePond']);

        $this->course->update($validated);

        return redirect()->route('file-uploads.edit')
            ->with('notification', 'Save successful!');
    }

    private function handleFile(?UploadedFile $file, array &$validated)
    {
        if ($file) {
            /** @var \Naykel\Gotime\DTO\FileInfo $fileInfo */
            $fileInfo = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated['image'] = $fileInfo->path();
        }
    }

    private function handleFilePondFile(?UploadedFile $file, array &$validated)
    {
        if ($file) {
            /** @var \Naykel\Gotime\DTO\FileInfo $fileInfo */
            $fileInfo = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated['image_filepond'] = $fileInfo->path();
        }
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <x-errors></x-errors>
                <form wire:submit.prevent="save">
                    <x-gt-file-input wire:model="tmpUpload" for="tmpUpload" default />
                    <x-livewire.filepond wire:model="tmpUploadFilePond" for="tmpUploadFilePond"/>
                    <div class="tar">
                        <x-gt-submit class="primary" />
                    </div>
                </form>
            </div>
        HTML;
    }
}
