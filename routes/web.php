<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/', function () {
    return redirect()->route('courses.index');
});

Route::resource('courses', CoursesController::class);
