<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class Genreform extends Component
{
    public $name = '';
    protected $rules = [
        'name' => ['required', 'string','max:60',  'unique:'.Genre::class],
    ];

    public function render()
    {
        return view('livewire.genreform');
    }

    public function create()
    {
        $this->validate();
        Genre::create(
            $this->only(['name'])
        );
        session()->put('status', 'Género añadido correctamente.');
    }
    public function deleteSession(){
        session()->forget('status');
    }
}
