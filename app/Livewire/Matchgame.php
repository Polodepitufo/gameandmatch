<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Matchgame extends Component
{

    public $arrayGeneros = array();
    public $arrayCategories = array();

    #[On('seleccionar')]
    #[On('deseleccionar')]
    #[On('matched')]
    #[On('unmatched')]
    public function render()
    {
        $genres =  Genre::orderBy('name', 'ASC')->get();
        $categories=Category::orderBy('name', 'ASC')->get();
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
            })->with(['categories'])->where(function ($query) {

                foreach ($this->arrayCategories as $category) {
                    $query->whereHas('categories', function ($q) use ($category) {
                        $q->where('id_category', $category);
                    });
                }
            })->take(1)->get();



        $arrayGenre = $this->arrayGeneros;
        $arrayCategory = $this->arrayCategories;

        return view('livewire.matchgame', compact('genres','categories', 'arrayGenre','arrayCategory', 'games'));
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
    public function unmatch($id)
    {

        DB::table("user_game")->insert([
            "id_game" => $id,
            "id_user" => Auth::user()->id ,
            "match" => 'NO',
            "state" => 'UNMATCHED',
        ]);
        $this->dispatch('unmatched');
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
    public function seleccionar2($id)
    {
        $categorySeleccionada = Category::where('id', $id)->value('id');
        array_push($this->arrayCategories, $categorySeleccionada);
        $this->dispatch('seleccionar');
    }

    public function deseleccionar2($id)
    {
        $categorySeleccionada = Category::where('id', $id)->value('id');
        $this->arrayCategories=array_diff($this->arrayCategories, [$categorySeleccionada]);
        $this->dispatch('deseleccionar');
    }

}
