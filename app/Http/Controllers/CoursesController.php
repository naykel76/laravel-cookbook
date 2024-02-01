<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CoursesController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::paginate(5),
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

    public function edit(Course $course)
    {
        return view('courses.create-edit', [
            'course' => $course,
            'pageTitle' => 'Edit Course'
        ]);
    }

    public function update(Course $course, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'code' => ['required', Rule::unique('courses')->ignore($course)],
            'price' => 'sometimes|regex:/^\d+(\.\d{2})?$/',
        ]);

        $course->update($validated);

        return redirect()->back()->with('notification', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }
}
