<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Categorytable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('editCategory')]
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
        $categories = Category::where('name', 'like', '%' . $this->search . '%')->simplePaginate(6);
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.categorytable', compact('categories'));
    }
    /**
     * Elimina el elemento en base al id que entra
     * En caso de que el elemento esté relacionado, se envía un mensaje informativo
     */
    public function delete($id)
    {
        try {
            Category::where('id', $id)->delete();
            session()->put('status', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar una categoría que ya ha sido vinculada.');
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
