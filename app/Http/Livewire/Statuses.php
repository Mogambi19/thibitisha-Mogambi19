<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class Statuses extends Component
{
    use WithPagination;

    public $name, $description, $status_id;
    public $showForm = false;
    public $isEditing = false;
    public $search = '';
    public $orderBy = 'name';
    public $orderDirection = 'asc';
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $query = Status::query();
        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }
        $statuses = $query->orderBy($this->orderBy, $this->orderDirection)->paginate(10);
        return view('livewire.statuses', [
            'statuses' => $statuses,
        ]);
    }

    public function add()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);
        $this->status_id = $status->id;
        $this->name = $status->name;
        $this->description = $status->description;
        $this->showForm = true;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate();
        Status::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Status created successfully.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function update()
    {
        $this->validate();
        $status = Status::findOrFail($this->status_id);
        $status->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Status updated successfully.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        session()->flash('success', 'Status deleted successfully.');
        $this->resetForm();
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function orderBy($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->orderDirection = 'asc';
        }
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->status_id = null;
        $this->isEditing = false;
    }
}
