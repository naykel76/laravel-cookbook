<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        $this->handleFile($request->file('image'), $validated);

        $course->update($validated);

        return redirect()->back()
            ->with('notification', 'Save successful!');
    }

    private function handleFile(?UploadedFile $file, array &$validated)
    {
        if ($file) {
            $path = FileManagement::saveWithUnique($file, $this->directory, $this->disk);
            $validated['image'] = $path;
        }
    }

    /**
     * Handles temporary file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string The path of the uploaded file or an empty string if no file was uploaded.
     */
    public function tmpUpload(Request $request): string
    {
        if ($request->hasFile('image_filepond')) {
            $file = $request->file('image_filepond');
            $directory = 'tmp/' . uniqid();
            $path = FileManagement::saveWithUnique($file, $directory, 'local');

            session(['' => [
                'name' => $path,
                'directory' => $directory,
            ]]);

            return $path;
        }
        return '';
    }

    /**
     * Deletes the temporary file upload and clears the session.
     *
     * @return \Illuminate\Http\Response
     */
    public function tmpDelete(): Response
    {
        $tmpUpload = session('tmpUpload');

        if ($tmpUpload) {
            Storage::deleteDirectory($tmpUpload['directory']);
            session()->forget('tmpUpload');
            return response('');
        }
    }
}
