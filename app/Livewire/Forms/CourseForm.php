<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CourseForm extends Form
{
    public Course $course;

    #[Validate('required|max:255')]
    public string $name;
    #[Validate('sometimes|regex:/^\d+(\.\d{2})?$/')]
    public ?string $price; // uses MoneyCast::class
    public string $code;
    #[Validate('sometimes')]
    public string $body;
    #[Validate('sometimes')]
    public string $status;
    #[Validate('sometimes')]
    public string $published_at;


    // there is no need to set the image in the model because it is not used
    // for binding and will not be handled until the save method is called
    #[Validate('required')]
    public $image;

    public function rules()
    {
        return [
            'code' => ['required', Rule::unique('courses')->ignore($this->course)],
        ];
    }

    /**
     * Sets the given model instance and updates the properties from the provided model.
     */
    public function setModel(Course $course): void
    {
        $this->course = $course;
        $this->name = $this->course->name ?? '';
        $this->code = $this->course->code ?? '';
        $this->price = sprintf("%.2f", $this->course->price);
        $this->body = $this->course->body ?? '';
        $this->status = $this->course->status->value ?? '';
    }

    public function getModel(): Course
    {
        return $this->course;
    }
}
