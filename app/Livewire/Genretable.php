<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Genretable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('editGenre')]
    #[On('search')]

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        // Resetea la página cuando se realiza una búsqueda

        if ($this->search != '') {
            $this->resetPage();
        }
        //Búsqueda con filtro y paginación
        $genres = Genre::where('name', 'like', '%' . $this->search . '%')->simplePaginate(6);
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.genretable', compact('genres'));
    }
    /**
     * Elimina el elemento en base al id que entra.
     * En caso de que el elemento esté relacionado, se envía un mensaje informativo
     */
    public function delete($id)
    {
        try {
            Genre::where('id', $id)->delete();
            session()->put('status', 'Genero eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar un género que ya ha sido vinculado.');
        };
    }
    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
