<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{
    //Propiedades públicas
    public $search = '';
    //Se manejan los eventos
    #[On('search')]
    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        //Búsqueda con filtro de los usuarios que no sean ni administradores ni superadministradores
        $users = User::where('nick', 'like', '%' . $this->search . '%')->whereNot('nick', Auth::user()->nick)->whereNot('rol', 'SUPERAD')->whereNot('rol', 'ADMIN')->take(1)->get();


        //Búsqueda de los id de los juegos que sean 'match' y no se estén en 'abandonado'. Los devuelve en un array
        $idGameList = DB::table('user_game')
            ->where('id_user', Auth::user()->id)
            ->where('user_game.match', 'SI')
            ->whereNot('user_game.state', 'ABANDONADO')
            ->pluck('id_game')
            ->toArray();

        //Búsqueda del usuario con más coincidencias en juegos
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
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.search', compact('users', 'soulmates'));
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
