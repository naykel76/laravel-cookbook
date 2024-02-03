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
        return view('pages.file-uploads', [
            'pageTitle' => 'File Uploads',
            'course' => Course::first()
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_filepond' => 'sometimes', // force the filepond filed in the validated
        ]);

        $this->handleFile($request->file('image'), $validated);

        if ($request->has('image_filepond')) {
            $this->handleFilePondFile($validated);
        }

        $course->update($validated);

        return redirect()->back()
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

    private function handleFilePondFile(array &$validated)
    {
        $tmpUpload = session('tmpUpload');
        $path = $this->directory . "/" . $tmpUpload['filename'];

        Storage::move(
            $tmpUpload['tmpDirectory'] . "/" . $tmpUpload['filename'],
            $this->disk . "/" . $path
        );

        session()->forget('tmpUpload');

        Storage::deleteDirectory($tmpUpload['tmpDirectory']);

        $validated['image_filepond'] = $path;
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
            // `uniqueDir` is used by filepond to retrieve the files
            $uniqueDir = 'tmp/' . uniqid(); // e.g. tmp/5f4b1c9b6b4a3
            /** @var \Naykel\Gotime\DTO\FileInfo $fileInfo */
            $fileInfo = FileManagement::saveWithUnique($file, $uniqueDir, 'local');

            session(['tmpUpload' => [
                'filename' => $fileInfo->name, // 1706770166-cats.jpg
                'tmpDirectory' => $fileInfo->directory, // tmp/65bb4094210e7
            ]]);

            return $uniqueDir;
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
            Storage::deleteDirectory($tmpUpload['tmpDirectory']);
            session()->forget('tmpUpload');

            // FilePond expects an empty response on successful deletion.
            // Do not change this to a success message or status code.
            return response('');
        }
    }
}
