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
    public $image;
    public $image_filepond;

    public function mount()
    {
        $this->course = Course::first();
    }

    public function save()
    {
        $validated = $this->validate([
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_filepond' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->handleFile($this->image, $validated, 'image');
        $this->handleFile($this->image_filepond, $validated, 'image_filepond');

        $this->course->update($validated);

        return redirect()->route('file-uploads.edit')
            ->with('notification', 'Save successful!');
    }

    private function handleFile(?UploadedFile $file, array &$validated, string $key)
    {

        // Remove null values from validated array to prevent overwriting
        // existing values with nulls when updating model.
        if ($validated[$key] == null) {
            unset($validated[$key]);
            return;
        }

        if ($file) {
            /** @var \Naykel\Gotime\DTO\FileInfo $fileInfo */
            $fileInfo = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated[$key] = $fileInfo->path();
        }
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <x-errors></x-errors>
                <form wire:submit.prevent="save">
                    <x-gt-file-input wire:model="image" for="image" default />
                    <x-livewire.filepond wire:model="image_filepond" for="image_filepond"/>
                    <div class="flex space-between">
                        <x-gt-submit class="primary" />
                    </div>
                </form>
            </div>
        HTML;
    }
}
