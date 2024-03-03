<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Libraryvaloration extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('search')]
    #[On('editValoration')]
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
        $gamesPuntuar = DB::table('user_game')
            ->join('games', 'user_game.id_game', '=', 'games.id')
            ->where('user_game.id_user', Auth::id())
            ->select('games.*', 'user_game.*')->groupBy('games.id')->orderBy('puntuation', 'desc')
            ->orderBy('games.id', 'asc')
            ->simplePaginate(6, ['*'], 'puntuados');
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.libraryvaloration', compact('gamesPuntuar'));
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
