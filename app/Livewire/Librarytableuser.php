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

    public User $user;
    public function render()
    {

        /*
            |--------------------------------------------------------------------------
            | Matched
            |--------------------------------------------------------------------------
            */
        $matched = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'MATCHED')->pluck('id_game');
        $gamesmatched = Game::whereIn('id', $matched)->with(['genres'])->simplePaginate(4, ['*'], 'matches');
        foreach ($gamesmatched as $gamematch) {
            $gamematch->background = file_exists('background/' . $gamematch->background) ? $gamematch->background : 'background.png';
        }
        /*
                |--------------------------------------------------------------------------
                | En juego
                |--------------------------------------------------------------------------
                */
        $enJuego = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'EN JUEGO')->pluck('id_game');
        $gamesenjuegos = Game::whereIn('id', $enJuego)->with(['genres'])->simplePaginate(4, ['*'], 'enjuego');
        foreach ($gamesenjuegos as $gamesEnJuego) {
            $gamesEnJuego->background = file_exists('background/' . $gamesEnJuego->background) ? $gamesEnJuego->background : 'background.png';
        }

        /*
                |--------------------------------------------------------------------------
                | En pausa
                |--------------------------------------------------------------------------
                */
        $enPausa = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'EN PAUSA')->pluck('id_game');
        $gamesenpausas = Game::whereIn('id', $enPausa)->with(['genres'])->simplePaginate(4, ['*'], 'enpausa');
        foreach ($gamesenpausas as $gamesenpausa) {
            $gamesenpausa->background = file_exists('background/' . $gamesenpausa->background) ? $gamesenpausa->background : 'background.png';
        }

        /*
                |--------------------------------------------------------------------------
                | Completados
                |--------------------------------------------------------------------------
                */
        $completados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'COMPLETADO')->pluck('id_game');
        $gamescompletados = Game::whereIn('id', $completados)->with(['genres'])->simplePaginate(4, ['*'], 'completados');
        foreach ($gamescompletados as $gamescompletado) {
            $gamescompletado->background = file_exists('background/' . $gamescompletado->background) ? $gamescompletado->background : 'background.png';
        }

        /*
                |--------------------------------------------------------------------------
                | Abandonados
                |--------------------------------------------------------------------------
                */
        $abandonados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'ABANDONADO')->pluck('id_game');
        $gamesabandonados = Game::whereIn('id', $abandonados)->with(['genres'])->simplePaginate(4, ['*'], 'abandonados');
        foreach ($gamesabandonados as $gamesabandonado) {
            $gamesabandonado->background = file_exists('background/' . $gamesabandonado->background) ? $gamesabandonado->background : 'background.png';
        }
        $unmatches = DB::table('user_game')->where('id_user', $this->user->id)->where('match', 'NO')->count();
        $matches = DB::table('user_game')->where('id_user', $this->user->id)->where('match', 'SI')->count();
        $completados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'COMPLETADO')->count();
        $abandonados = DB::table('user_game')->where('id_user', $this->user->id)->where('state', 'ABANDONADO')->count();
        return view('livewire.librarytableuser', compact('gamesmatched', 'gamesenjuegos', 'gamesenpausas', 'gamescompletados', 'gamesabandonados', 'unmatches', 'matches', 'completados', 'abandonados'));
    }
    public function mount(User $user)
    {
        $this->user = $user;
    }
}
