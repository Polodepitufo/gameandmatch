<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Librarytable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    //Se manejan los eventos
    #[On('jugar')]
    #[On('pausar')]
    #[On('abandonar')]
    #[On('completar')]
    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        //Matched
        //Obtiene los IDs de los juegos en estado 'MATCHED' para el usuario autenticado
        $matched = DB::table('user_game')
            ->where('id_user', Auth::id())->where('state', 'MATCHED')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesmatched = Game::whereIn('id', $matched)->with(['genres'])->simplePaginate(4, ['*'], 'matches');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesmatched as $gamematch) {
            $gamematch->background = file_exists('background/' . $gamematch->background) ? $gamematch->background : 'background.png';
        }

        //En juego
        //Obtiene los IDs de los juegos en estado 'EN JUEGO' para el usuario autenticado
        $enJuego = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'EN JUEGO')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesenjuegos = Game::whereIn('id', $enJuego)->with(['genres'])->simplePaginate(4, ['*'], 'enjuego');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesenjuegos as $gamesEnJuego) {
            $gamesEnJuego->background = file_exists('background/' . $gamesEnJuego->background) ? $gamesEnJuego->background : 'background.png';
        }

        //En pausa
        //Obtiene los IDs de los juegos en estado 'EN PAUSA' para el usuario autenticado
        $enPausa = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'EN PAUSA')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesenpausas = Game::whereIn('id', $enPausa)->with(['genres'])->simplePaginate(4, ['*'], 'enpausa');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesenpausas as $gamesenpausa) {
            $gamesenpausa->background = file_exists('background/' . $gamesenpausa->background) ? $gamesenpausa->background : 'background.png';
        }

        //Completado
        //Obtiene los IDs de los juegos en estado 'COMPLETADO' para el usuario autenticado
        $completados = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'COMPLETADO')->pluck('id_game');
             //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamescompletados = Game::whereIn('id', $completados)->with(['genres'])->simplePaginate(4, ['*'], 'completados');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamescompletados as $gamescompletado) {
            $gamescompletado->background = file_exists('background/' . $gamescompletado->background) ? $gamescompletado->background : 'background.png';
        }

        //Abandonado
        //Obtiene los IDs de los juegos en estado 'ABANDONADO' para el usuario autenticado
        $abandonados = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'ABANDONADO')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesabandonados = Game::whereIn('id', $abandonados)->with(['genres'])->simplePaginate(4, ['*'], 'abandonados');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesabandonados as $gamesabandonado) {
            $gamesabandonado->background = file_exists('background/' . $gamesabandonado->background) ? $gamesabandonado->background : 'background.png';
        }

        return view('livewire.librarytable', compact('gamesmatched', 'gamesenjuegos', 'gamesenpausas', 'gamescompletados', 'gamesabandonados'));
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }

    /**
     * Cambia el estado del juego a 'En juego'
     */
    public function jugar($id)
    {
        // Actualiza el estado del juego
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'EN JUEGO']);
        //Se emite un evento
        $this->dispatch('jugar');
        session()->put('status', 'Cambio de estado a EN JUEGO.');
    }

    /**
     * Cambia el estado del juego a 'En pausa'
     */
    public function pausar($id)
    {
        // Actualiza el estado del juego
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'EN PAUSA']);
        //Se emite un evento
        $this->dispatch('pausar');
        session()->put('status', 'Cambio de estado a EN PAUSA.');
    }

    /**
     * Cambia el estado del juego a 'Abandonado'
     */
    public function abandonar($id)
    {
        // Actualiza el estado del juego
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'ABANDONADO']);
        //Se emite un evento
        $this->dispatch('abandonar');
        session()->put('status', 'Cambio de estado a ABANDONADO.');
    }

    /**
     * Cambia el estado del juego a 'Completado'
     */
    public function completar($id)
    {
        // Actualiza el estado del juego
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'COMPLETADO']);
        //Se emite un evento
        $this->dispatch('completar');
        session()->put('status', 'Cambio de estado a COMPLETADO.');
    }
}
