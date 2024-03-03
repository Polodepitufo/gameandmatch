<?php

namespace App\Livewire;

use App\Http\Requests\genreEditRequest;
use App\Models\Genre;
use Livewire\Attributes\On;
use Livewire\Component;

class Genreedit extends Component
{
    //Propiedades públicas
    public $name = '';
    public Genre $genre;

    /**
     * Reglas de validación
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'max:60', 'unique:' . Genre::class],
        ];
    }

    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount(Genre $genre)
    {
        $this->name = $genre->name;
        $this->genre = $genre;
    }

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        return view('livewire.genreedit');
    }

    /**
     * Actualiza la información correspondiente
     */
    public function update()
    {
        // Se reinician la reglas de validación
        $this->resetValidation();
        // Se compueba que el nombre no se emplea para otros géneros
        $genreComprobar = Genre::where('id', $this->genre['id'])->get();
        foreach ($genreComprobar as $gen) {
            // Si el nombre es único, entonces hace la validación
            if ($gen->name != $this->name) {
                $this->validate();
            }
        }
        // Se actualiza y se guardan cambios
        $this->genre['name'] = $this->name;
        $this->genre->save();
        //Se emite un evento
        $this->dispatch('editGenre');
        session()->put('status', 'Género editado correctamente.');
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
