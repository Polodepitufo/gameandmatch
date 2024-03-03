<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Libraryedit extends Component
{
    //Propiedades públicas
    public $id;
    public $puntuation;
    public $valoration;

    /**
     * Reglas de validación
     */
    protected $rules = [
        'valoration' => ['max:255'],
        'puntuation' => ['numeric', 'between:0,10']

    ];

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        return view('livewire.libraryedit');
    }

    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount($id, $puntuation, $valoration)
    {
        $this->id = $id;
        $this->puntuation = $puntuation;
        $this->valoration = $valoration;
    }

    /**
     * Actualiza la información correspondiente
     */
    public function update()
    {
        // Se reinician la reglas de validación
        $this->resetValidation();
        //Se valida
        $this->validate();
        // Se actualiza y se guardan cambios
        DB::table('user_game')
            ->where('id', $this->id)
            ->update(['valoration' => $this->valoration, 'puntuation' => $this->puntuation]);
        //Se emite un evento
        $this->dispatch('editValoration');
        session()->put('status', 'Valoración y puntuación editadas correctamente.');
    }


    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
