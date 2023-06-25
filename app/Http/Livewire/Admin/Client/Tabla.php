<?php

namespace App\Http\Livewire\Admin\Client;

use Livewire\Component;
use App\Models\Client;
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
        $clients = Client::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('address', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('taxpayer_id', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginate);
        return view('livewire.admin.client.tabla', compact('clients'));
    }
}
