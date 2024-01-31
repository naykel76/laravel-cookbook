<?php

namespace App\Livewire\Course;

use App\Traits\Sortable;
use App\Models\Course;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[On('saved')]
class Table extends Component
{
    use WithPagination;
    use Sortable;

    public string $routePrefix = 'admin.course';

    public function render()
    {
        $query = Course::query();
        $query = $this->applySorting($query);

        return view('livewire.course.table', [
            'courses' => $query->paginate(3),
        ]);
    }
}
