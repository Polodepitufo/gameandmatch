<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class Genreform extends Component
{
    //Propiedades públicas
    public $name = '';
    //Reglas de validación
    protected $rules = [
        'name' => ['required', 'string', 'max:60',  'unique:' . Genre::class],
    ];

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        return view('livewire.genreform');
    }

    /**
     * Crea un nuevo elemento
     */
    public function create()
    {
        //Se validan los datos según las reglas definidas
        $this->validate();
        //Se crea un nuevo género
        Genre::create(
            $this->only(['name'])
        );
        session()->put('status', 'Género añadido correctamente.');
    }
    
    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
