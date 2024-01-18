<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Librarystats extends Component
{


    #[On('jugar')]
    #[On('pausar')]
    #[On('abandonar')]
    #[On('completar')]
    public function render()
    {
        $unmatches = DB::table('user_game')->where('id_user', Auth::id())->where('match', 'NO')->count();
        $matches = DB::table('user_game')->where('id_user', Auth::id())->where('match', 'SI')->count();
        $completados = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'COMPLETADO')->count();
        $abandonados = DB::table('user_game')->where('id_user', Auth::id())->where('state', 'ABANDONADO')->count();
        return view('livewire.librarystats', compact('unmatches','matches','completados','abandonados'));
    }
}
