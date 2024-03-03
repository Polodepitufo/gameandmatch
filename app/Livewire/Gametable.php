<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Gametable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('editGame')]
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
        $games = Game::where('name', 'like', '%' . $this->search . '%')->with(['genres'])->simplePaginate(6);
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.gametable', compact('games'));
    }
    /**
     * Elimina el elemento en base al id que entra. También géneros y categorias asociadas
     * En caso de que el elemento esté relacionado, se envía un mensaje informativo
     */
    public function delete($id)
    {
        try {
            Game::where('id', $id)->delete();
            DB::table('game_genre')->where('id_game', $id)->delete();
            DB::table('game_category')->where('id_game', $id)->delete();

            session()->put('status', 'Juego eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar una juego que ya ha sido vinculado.');
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
