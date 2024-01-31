<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Naykel\Gotime\Facades\FileManagement;

class FileUploadsController extends Controller
{
    protected string $disk = 'public';
    protected string $directory = 'courses';

    public function edit()
    {
        return view('file-uploads.edit', [
            'pageTitle' => 'File Uploads',
            'course' => Course::first()
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ]);

        $this->handleFile($request->file('image'), $validated);

        $course->update($validated);

        return redirect()->back()
            ->with('notification', 'Save successful!');
    }

    // this code is duplicated in the Livewire `FileUpload` component
    // and should be refactored into a service class
    private function handleFile(UploadedFile $file, array &$validated)
    {
        if ($file) {
            $path = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated['image'] = $path;
        }
    }
}
