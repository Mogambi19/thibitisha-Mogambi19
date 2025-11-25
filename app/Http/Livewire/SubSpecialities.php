<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SubSpeciality;

class SubSpecialities extends Component
{
    use WithPagination;

    public $search = '';
    public $orderField = 'name';
    public $orderDirection = 'asc';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function orderBy($field)
    {
        if ($this->orderField === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderField = $field;
            $this->orderDirection = 'asc';
        }
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        $query = SubSpeciality::with('speciality');
        if (trim($this->search) !== '') {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $subspecialities = $query->orderBy($this->orderField, $this->orderDirection)
            ->paginate(env('PAGINATION_COUNT', 10));
        return view('livewire.sub-specialities', [
            'subspecialities' => $subspecialities,
            'orderDirection' => $this->orderDirection,
        ]);
    }
}
