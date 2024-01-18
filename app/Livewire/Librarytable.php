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

    #[On('jugar')]
    #[On('pausar')]
    #[On('abandonar')]
    #[On('completar')]
    public function render()
    {
        /*
            |--------------------------------------------------------------------------
            | Matched
            |--------------------------------------------------------------------------
            */
        $matched = DB::table('user_game')
        ->where('id_user', Auth::id())
            ->where('state', 'MATCHED')
            ->pluck('id_game');
        $gamesmatched = Game::whereIn('id', $matched)->with(['genres'])->simplePaginate(4, ['*'], 'matches');
        foreach ($gamesmatched as $gamematch) {
            $gamematch->background = file_exists('background/' . $gamematch->background) ? $gamematch->background : 'background.png';
        }
        /*
            |--------------------------------------------------------------------------
            | En juego
            |--------------------------------------------------------------------------
            */
        $enJuego = DB::table('user_game')
            ->where('id_user', Auth::id())
            ->where('state', 'EN JUEGO')
            ->pluck('id_game');
        $gamesenjuegos = Game::whereIn('id', $enJuego)->with(['genres'])->simplePaginate(4, ['*'], 'enjuego');
        foreach ($gamesenjuegos as $gamesEnJuego) {
            $gamesEnJuego->background = file_exists('background/' . $gamesEnJuego->background) ? $gamesEnJuego->background : 'background.png';
        }

        /*
            |--------------------------------------------------------------------------
            | En pausa
            |--------------------------------------------------------------------------
            */
        $enPausa = DB::table('user_game')
            ->where('id_user', Auth::id())
            ->where('state', 'EN PAUSA')
            ->pluck('id_game');
        $gamesenpausas = Game::whereIn('id', $enPausa)->with(['genres'])->simplePaginate(4, ['*'], 'enpausa');
        foreach ($gamesenpausas as $gamesenpausa) {
            $gamesenpausa->background = file_exists('background/' . $gamesenpausa->background) ? $gamesenpausa->background : 'background.png';
        }

        /*
            |--------------------------------------------------------------------------
            | Completados
            |--------------------------------------------------------------------------
            */
        $completados = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'COMPLETADO')->pluck('id_game');
        $gamescompletados = Game::whereIn('id', $completados)->with(['genres'])->simplePaginate(4, ['*'], 'completados');
        foreach ($gamescompletados as $gamescompletado) {
            $gamescompletado->background = file_exists('background/' . $gamescompletado->background) ? $gamescompletado->background : 'background.png';
        }

        /*
            |--------------------------------------------------------------------------
            | Abandonados
            |--------------------------------------------------------------------------
            */
        $abandonados = DB::table('user_game')
        ->where('id_user', Auth::id())
            ->where('state', 'ABANDONADO')
            ->pluck('id_game');
        $gamesabandonados = Game::whereIn('id', $abandonados)->with(['genres'])->simplePaginate(4, ['*'], 'abandonados');
        foreach ($gamesabandonados as $gamesabandonado) {
            $gamesabandonado->background = file_exists('background/' . $gamesabandonado->background) ? $gamesabandonado->background : 'background.png';
        }

        return view('livewire.librarytable', compact('gamesmatched', 'gamesenjuegos', 'gamesenpausas', 'gamescompletados', 'gamesabandonados'));
    }


    public function deleteSession()
    {
        session()->forget('status');
    }

    public function jugar($id)
    {
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'EN JUEGO']);
        $this->dispatch('jugar');
        session()->put('status', 'Cambio de estado a EN JUEGO.');
    }

    public function pausar($id)
    {
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'EN PAUSA']);
        $this->dispatch('pausar');
        session()->put('status', 'Cambio de estado a EN PAUSA.');
    }

    public function abandonar($id)
    {
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'ABANDONADO']);
        $this->dispatch('abandonar');
        session()->put('status', 'Cambio de estado a ABANDONADO.');
    }

    public function completar($id)
    {
        DB::table('user_game')->where('id_game', $id)->update(['state' => 'COMPLETADO']);
        $this->dispatch('completar');
        session()->put('status', 'Cambio de estado a COMPLETADO.');
    }
}
