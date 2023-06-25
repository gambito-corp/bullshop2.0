<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
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
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginate);

        return view('livewire.admin.users.tabla', compact('users'));
    }

    public function impersonateUser($id)
    {
        return redirect()->route('admin.users.impersonar', $id);
    }
}
