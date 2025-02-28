<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    public $name;
    use WithPagination;
    #[Rule('required|')]

    public function render()
    {
        return view('livewire.todo-list');
    }
}
