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
    public $search = '';

    #[On('search')]
    #[On('editValoration')]
    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        $gamesPuntuar = DB::table('user_game')
        ->join('games', 'user_game.id_game', '=', 'games.id')
        ->where('user_game.id_user', Auth::id())
        ->select('games.*','user_game.*')->orderBy('puntuation','desc')
        ->simplePaginate(6, ['*'], 'puntuados');

        $this->dispatch('search');
        return view('livewire.libraryvaloration', compact('gamesPuntuar'));
    }
    public function deleteSession()
    {
        session()->forget('status');
    }
}
