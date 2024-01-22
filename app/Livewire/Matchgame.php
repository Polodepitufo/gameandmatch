<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Matchgame extends Component
{

    public $arrayGeneros = array();


    #[On('seleccionar')]
    #[On('deseleccionar')]
    public function render()
    {
        $genres =  Genre::orderBy('name', 'ASC')->get();
            $games = Game::whereNotIn('id', function ($query) {
                $query->select('id_game')
                ->from('user_game')
                ->where('id_user', Auth::id());
            })->with(['genres'])->where(function ($query) {

                foreach ($this->arrayGeneros as $genre) {
                    $query->whereHas('genres', function ($q) use ($genre) {
                        $q->where('id_genre', $genre);
                    });
                }
            })->take(1)->get();
        $array = $this->arrayGeneros;
        return view('livewire.matchgame', compact('genres', 'array', 'games'));
    }


    public function seleccionar($id)
    {
        $genreSeleccionado = Genre::where('id', $id)->value('id');
        array_push($this->arrayGeneros, $genreSeleccionado);
        $this->dispatch('seleccionar');
    }

    public function deseleccionar($id)
    {
        $genreSeleccionado = Genre::where('id', $id)->value('id');
        $this->arrayGeneros=array_diff($this->arrayGeneros, [$genreSeleccionado]);
        $this->dispatch('deseleccionar');
    }
}
