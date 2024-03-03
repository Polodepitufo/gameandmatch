<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboardtable extends Component
{
    //Se manejan los eventos
    #[On('matched')]
    /**
     * Carga la vista correspondiente 
     */
    public function render()
    {
        //Selecciona los últimos 16 juegos añadidos a la base de datos con los que no tengas ya una coincidencia
        $games = Game::whereNotIn('id', function ($query) {
            $query->select('id_game')
                ->from('user_game')
                ->where('id_user', Auth::id());
        })->with(['genres'])->latest()->take(16)->get();

        // Verifica y ajusta el fondo de los juegos
        foreach ($games as $game) {
            $game->background = file_exists('background/' . $game->background) ? $game->background : 'background.png';
        }
        return view('livewire.dashboardtable', compact('games'));
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
