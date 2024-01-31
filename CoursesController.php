<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::paginate(10),
            'pageTitle' => 'Course Index'
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Course $course)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Course $course, Request $request)
    {
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }
}
