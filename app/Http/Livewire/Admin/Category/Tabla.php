<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'name';
    public $direction = 'asc';
    public $paginate = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort' => ['except' => 'name'],
        'direction' => ['except' => 'asc'],
        'paginate' => ['except' => 10],
    ];

    public function sort($field)
    {
        if ($this->sort === $field) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $field;
            $this->direction = 'asc';
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginate);

        return view('livewire.admin.category.tabla', compact('categories'));
    }
}
