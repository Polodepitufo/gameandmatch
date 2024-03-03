<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Librarytableuser extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Propiedades públicas
    public User $user;

    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function render()
    {

        //Matched
        //Obtiene los IDs de los juegos en estado 'MATCHED' para el usuario autenticado
        $matched = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'MATCHED')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesmatched = Game::whereIn('id', $matched)->with(['genres'])->simplePaginate(4, ['*'], 'matches');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesmatched as $gamematch) {
            $gamematch->background = file_exists('background/' . $gamematch->background) ? $gamematch->background : 'background.png';
        }

        //En juego
        //Obtiene los IDs de los juegos en estado 'EN JUEGO' para el usuario autenticado
        $enJuego = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'EN JUEGO')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesenjuegos = Game::whereIn('id', $enJuego)->with(['genres'])->simplePaginate(4, ['*'], 'enjuego');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesenjuegos as $gamesEnJuego) {
            $gamesEnJuego->background = file_exists('background/' . $gamesEnJuego->background) ? $gamesEnJuego->background : 'background.png';
        }

        //En pausa
        //Obtiene los IDs de los juegos en estado 'EN PAUSA' para el usuario autenticado
        $enPausa = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'EN PAUSA')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesenpausas = Game::whereIn('id', $enPausa)->with(['genres'])->simplePaginate(4, ['*'], 'enpausa');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesenpausas as $gamesenpausa) {
            $gamesenpausa->background = file_exists('background/' . $gamesenpausa->background) ? $gamesenpausa->background : 'background.png';
        }

        //Completado
        //Obtiene los IDs de los juegos en estado 'COMPLETADO' para el usuario autenticado
        $completados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'COMPLETADO')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamescompletados = Game::whereIn('id', $completados)->with(['genres'])->simplePaginate(4, ['*'], 'completados');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamescompletados as $gamescompletado) {
            $gamescompletado->background = file_exists('background/' . $gamescompletado->background) ? $gamescompletado->background : 'background.png';
        }

        //Abandonado
        //Obtiene los IDs de los juegos en estado 'ABANDONADO' para el usuario autenticado
        $abandonados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'ABANDONADO')->pluck('id_game');
        //Obtiene los juegos relacionados con los ids previamente obtenidos
        $gamesabandonados = Game::whereIn('id', $abandonados)->with(['genres'])->simplePaginate(4, ['*'], 'abandonados');
        // Verifica y asigna un fondo predeterminado si no existe
        foreach ($gamesabandonados as $gamesabandonado) {
            $gamesabandonado->background = file_exists('background/' . $gamesabandonado->background) ? $gamesabandonado->background : 'background.png';
        }
        $unmatches = DB::table('user_game')->where('id_user', $this->user->id)->where('match', 'NO')->count();
        $matches = DB::table('user_game')->where('id_user', $this->user->id)->where('match', 'SI')->count();
        $completados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'COMPLETADO')->count();
        $abandonados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'ABANDONADO')->count();
        return view('livewire.librarytableuser', compact('gamesmatched', 'gamesenjuegos', 'gamesenpausas', 'gamescompletados', 'gamesabandonados', 'unmatches', 'matches', 'completados', 'abandonados'));
    }
}
