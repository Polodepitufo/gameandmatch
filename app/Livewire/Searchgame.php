<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Searchgame extends Component
{
    public $search = '';


    #[On('search')]
    public function render()
    {
        $search=$this->search;
        $games = Game::whereNotIn('id', function ($query) {
            $query->select('id_game')
                ->from('user_game')
                ->where('id_user', Auth::id());

        })->with(['genres'])->where('name', 'like', '%' . $this->search . '%')->take(1)->get();

        $this->dispatch('search');
        return view('livewire.searchgame', compact('games', 'search'));
    }
}
