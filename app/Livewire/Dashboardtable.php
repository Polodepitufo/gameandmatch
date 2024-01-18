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

    #[On('matched')]
    public function render()
    {
        $games = Game::whereNotIn('id', function ($query) {
            $query->select('id_game')
            ->from('user_game')
            ->where('id_user', Auth::id());
        })->with(['genres'])->latest()->take(16)->get();


        foreach ($games as $game) {
            $game->background = file_exists('background/' . $game->background) ? $game->background : 'background.png';
        }
        return view('livewire.dashboardtable', compact('games'));
    }
    public function deleteSession()
    {
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
