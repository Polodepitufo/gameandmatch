<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Libraryvalorationuser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //Propiedades públicas
    public $search = '';
    public User $user;

    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount(User $user)
    {
        $this->user = $user;
    }

    //Se manejan los eventos
    #[On('searchuser')]
    public function render()
    {
        // Resetea la página cuando se realiza una búsqueda
        if ($this->search != '') {
            $this->resetPage();
        }
        //Búsqueda con filtro y paginación
        $gamesPuntuar = DB::table('user_game')
            ->join('games', 'user_game.id_game', '=', 'games.id')
            ->where('user_game.id_user', $this->user->id)
            ->select('games.*', 'user_game.*')->groupBy('games.id')->orderBy('puntuation', 'desc')
            ->orderBy('games.id', 'asc')
            ->simplePaginate(6, ['*'], 'puntuados');
        //Se emite un evento
        $this->dispatch('searchuser');
        return view('livewire.libraryvalorationuser', compact('gamesPuntuar'));
    }
    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
