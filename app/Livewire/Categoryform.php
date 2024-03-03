<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categoryform extends Component
{
    //Propiedades públicas
    public $name = '';
    //Reglas de validación
    protected $rules = [
        'name' => ['required', 'string', 'max:60',  'unique:' . Category::class],
    ];

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        return view('livewire.categoryform');
    }
    /**
     * Crea un nuevo elemento
     */
    public function create()
    {
        //Se validan los datos según las reglas definidas
        $this->validate();
        // Se crea una nueva categoría 
        Category::create(
            $this->only(['name'])
        );
        session()->put('status', 'Categoría añadida correctamente.');
    }
    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
