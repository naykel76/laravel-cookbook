<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FileUploadsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::resource('courses', CoursesController::class);

Route::controller(FileUploadsController::class)
    ->name('file-uploads')->prefix('file-uploads')->group(function () {
        Route::get('/edit', 'edit')->name('.edit');
        Route::put('{course}/update', 'update')->name('.update');
        Route::post('/tmp-upload', 'tmpUpload')->name('tmp-upload');
        Route::delete('/tmp-delete', 'tmpDelete')->name('tmp-delete');
    });
