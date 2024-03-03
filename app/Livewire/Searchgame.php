<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Searchgame extends Component
{
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('search')]
    #[On('matched')]
    /**
     * Carga la vista correspondiente
     */
    public function render()
    {

        //Búsqueda con filtro 
        $search = $this->search;
        $games = Game::whereNotIn('id', function ($query) {
            $query->select('id_game')
                ->from('user_game')
                ->where('id_user', Auth::id());
        })->with(['genres'])->where('name', 'like', '%' . $this->search . '%')->take(1)->get();
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.searchgame', compact('games', 'search'));
    }
    
    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }

    /**
     * Realiza un match entre el usuario y el juego
     */
    public function match($id)
    {
        //Inserta un nuevo registro
        DB::table("user_game")->insert([
            "id_game" => $id,
            "id_user" => Auth::user()->id,
            "match" => 'SI',
            "state" => 'MATCHED',
        ]);
        //Se emite un evento
        $this->dispatch('matched');
        session()->put('status', 'Has hecho match.');
    }
}
