<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    #[On('search')]
    public
    function render()
    {
        $users = User::where('nick', 'like', '%' . $this->search . '%')->whereNot('nick', Auth::user()->nick)->whereNot('rol', 'SUPERAD')->whereNot('rol', 'ADMIN')->take(1)->get();

        $idGameList = DB::table('user_game')->where('id_user', Auth::user()->id)->where('user_game.match', 'SI')->whereNot('user_game.state', 'ABANDONADO')->pluck('id_game')->toArray();
        $soulmates = DB::table('user_game')
        ->join('users', 'user_game.id_user', '=', 'users.id')
        ->select('users.nick', 'user_game.id_user', DB::raw('COUNT(user_game.id_game) as coincidencias'))
        ->havingRaw('coincidencias > 5')
        ->whereIn('user_game.id_game', $idGameList)
            ->where('user_game.id_user', '!=', Auth::user()->id)
            ->where('user_game.match', 'SI')
            ->whereNot('user_game.state', 'ABANDONADO')
            ->groupBy('users.name', 'user_game.id_user')
            ->orderBy('coincidencias')
            ->take(1)
            ->get();
        $this->dispatch('search');
        return view('livewire.search', compact('users', 'soulmates'));
    }


    public function deleteSession(){
        session()->forget('status');
    }

}
