<?php

namespace App\Livewire\Course;

use App\Livewire\Forms\CourseForm;
use App\Models\Course;
use App\Traits\Crudable;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class CreateEdit extends Component
{
    use Crudable;

    public CourseForm $form;
    public string $routePrefix = 'course';
    public string $mainImage;

    public function mount(Course $course)
    {
        // $model = $course->id ? $course : new Course;
        $model = Course::first();
        $this->form->setModel($model);
        $this->pageTitle = $this->setPageTitle($this->routePrefix);
        $this->mainImage = $model->image ?? '';
    }

    public function afterPersistHook () {
        $this->redirect('/courses/1/edit');
        // $this->redirectRoute('courses.edit', ['id' => 1]);
    //    $this->redirect()->route("{$this->routePrefix}.index");
    }

    public function render()
    {
        $view = view('livewire.course.create-edit-form');

        //  If the route matches a `named` route then we are returning a full
        //  page component. Otherwise, we want to render the component inline.
        if (Route::is("{$this->routePrefix}.edit") || Route::is("{$this->routePrefix}.create")) {
            $view->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
                'mainClasses' => true, // this is being used as a flag
            ]);
        }

        return $view;
    }
}
