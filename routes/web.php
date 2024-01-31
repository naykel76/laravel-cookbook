<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FileUploadsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::resource('courses', CoursesController::class);

Route::controller(FileUploadsController::class)
    ->name('file-uploads')->group(function () {
        Route::get('/edit', 'edit')->name('.edit'); // will just select the first course
        Route::put('{course}/update', 'update')->name('.update');
    });

