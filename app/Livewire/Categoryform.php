<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categoryform extends Component
{
    public $name = '';
    protected $rules = [
        'name' => ['required', 'string','max:60',  'unique:'.Category::class],
    ];

    public function render()
    {
        return view('livewire.categoryform');
    }

    public function create()
    {
        $this->validate();
        Category::create(
            $this->only(['name'])
        );
        session()->put('status', 'Categoría añadida correctamente.');
    }
    public function deleteSession(){
        session()->forget('status');
    }
}

