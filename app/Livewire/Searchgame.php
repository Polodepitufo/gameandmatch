<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Searchgame extends Component
{
    public $search = '';


    #[On('search')]
    #[On('matched')]
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
    
    public function deleteSession(){
        session()->forget('status');
    }

    public function match($id)
    {

        DB::table("user_game")->insert([
            "id_game" => $id,
            "id_user" => Auth::user()->id ,
            "match" => 'SI',
            "state" => 'MATCHED',
        ]);
        $this->dispatch('matched');
        session()->put('status', 'Has hecho match.');
    }


}
