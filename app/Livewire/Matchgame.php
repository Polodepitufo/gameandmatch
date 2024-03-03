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
    //Propiedades públicas
    public $arrayGeneros = array();
    public $arrayCategories = array();

    //Se manejan los eventos
    #[On('seleccionar')]
    #[On('deseleccionar')]
    #[On('matched')]
    #[On('unmatched')]
    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        $genres =  Genre::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        //Búsqueda en base a la selección de género y categoría 
        $games = Game::whereNotIn('id', function ($query) {
            $query->select('id_game')
                ->from('user_game')
                ->where(
                    'id_user',
                    Auth::id()
                );
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

        return view('livewire.matchgame', compact('genres', 'categories', 'arrayGenre', 'arrayCategory', 'games'));
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }

    /**
     * Realiza un match entre el usuario y el juego
     */
    public function match($id)
    {
        //Inserta un nuevo registro
        DB::table("user_game")->insert([
            "id_game" => $id,
            "id_user" => Auth::user()->id,
            "match" => 'SI',
            "state" => 'MATCHED',
        ]);
        //Se emite un evento
        $this->dispatch('matched');
        session()->put('status', 'Has hecho match.');
    }

    /**
     * Realiza un unmatch entre el usuario y el juego
     */
    public function unmatch($id)
    {
        //Inserta un nuevo registro
        DB::table("user_game")->insert([
            "id_game" => $id,
            "id_user" => Auth::user()->id,
            "match" => 'NO',
            "state" => 'UNMATCHED',
        ]);
        //Se emite un evento
        $this->dispatch('unmatched');
    }

    /**
     * Selecciona un género 
     */
    public function seleccionar($id)
    {
        // Obtiene el ID del género seleccionado
        $genreSeleccionado = Genre::where('id', $id)->value('id');
        // Añade el ID del género al array
        array_push($this->arrayGeneros, $genreSeleccionado);
        //Se emite un evento
        $this->dispatch('seleccionar');
    }

    /**
     * Deselecciona un género 
     */
    public function deseleccionar($id)
    {
        // Obtiene el ID del género seleccionado
        $genreSeleccionado = Genre::where('id', $id)->value('id');
        // Elimina el ID del género del array 
        $this->arrayGeneros = array_diff($this->arrayGeneros, [$genreSeleccionado]);
        //Se emite un evento
        $this->dispatch('deseleccionar');
    }

    /**
     * Selecciona una categoría
     */
    public function seleccionar2($id)
    {
        // Obtiene el ID de la categoría seleccionada
        $categorySeleccionada = Category::where('id', $id)->value('id');
        // Añade el ID de la categoría al array
        array_push($this->arrayCategories, $categorySeleccionada);
        //Se emite un evento
        $this->dispatch('seleccionar');
    }

    /**
     * Deselecciona una categoría 
     */
    public function deseleccionar2($id)
    {
        // Obtiene el ID de la categoría seleccionada
        $categorySeleccionada = Category::where('id', $id)->value('id');
        // Elimina el ID de la categoría del array 
        $this->arrayCategories = array_diff($this->arrayCategories, [$categorySeleccionada]);
        //Se emite un evento
        $this->dispatch('deseleccionar');
    }
}
