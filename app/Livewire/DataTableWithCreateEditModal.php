<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Sortable;

class DataTableWithCreateEditModal extends Component
{
    use WithPagination;
    use Sortable;

    public string $routePrefix = 'admin.course';

    public function render()
    {
        $query = Course::query();
        $query = $this->applySorting($query);

        return view('livewire.data-table-with-create-edit-modal', [
            'courses' => $query->paginate(3),
        ]);
    }
}
