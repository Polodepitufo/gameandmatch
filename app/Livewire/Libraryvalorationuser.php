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
    public $search = '';
    public User $user;
    #[On('searchuser')]
    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        $gamesPuntuar = DB::table('user_game')
        ->join('games', 'user_game.id_game', '=', 'games.id')
        ->where('user_game.id_user', $this->user->id)
        ->select('games.*','user_game.*')->groupBy('games.id')->orderBy('puntuation','desc')
        ->simplePaginate(6, ['*'], 'puntuados');

        $this->dispatch('searchuser');
        return view('livewire.libraryvalorationuser', compact('gamesPuntuar'));
    }
    public function deleteSession()
    {
        session()->forget('status');
    }
    public function mount(User $user)
    {
        $this->user = $user;
    }
}
