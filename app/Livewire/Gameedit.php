<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Gameedit extends Component
{
    //Propiedades públicas
    public $name = '';
    public $id = '';
    public $description = '';
    public $platform = '';
    public Game $game;
    public $genres_;
    public $categories_;
    /**
     * Reglas de validación
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'max:60', 'unique:' . Game::class],
            'description' => ['required', 'max:255'],
            'platform' => ['required']
        ];
    }
    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount(Game $game)
    {
        $this->id = $game->id;
        $this->name = $game->name;
        $this->description = $game->description;
        $this->game = $game;
        $this->platform =  $game->platform;

        $selectedGenres =  DB::table("game_genre")->where('id_game', $game->id)->pluck('id_genre')->toArray();
        $selectedCategories =  DB::table("game_category")->where('id_game', $game->id)->pluck('id_category')->toArray();

        $this->categories_ = $selectedCategories;
        $this->genres_ = $selectedGenres;
    }

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.gameedit', compact('genres', 'categories'));
    }

    public function update()
    {
        // Se reinician la reglas de validación
        $this->resetValidation();
        // Se compueba que el nombre no se emplea para otros juegos
        $gameComprobar = Game::where('id', $this->game['id'])->get();
        foreach ($gameComprobar as $gam) {
            // Si el nombre es único, entonces hace la validación
            if ($gam->name != $this->name) {
                $this->validate();
            }
        }
        // Inserta los nuevos registros 
        DB::table('game_genre')->where('id_game', $this->id)->delete();
        foreach ($this->genres_ as $genre) {
            DB::table("game_genre")->updateOrInsert([
                "id_game" => $this->id,
                "id_genre" => $genre
            ]);
        }

        // Inserta los nuevos registros 
        DB::table('game_category')->where('id_game', $this->id)->delete();
        foreach ($this->categories_ as $category) {
            DB::table("game_category")->updateOrInsert([
                "id_game" => $this->id,
                "id_category" => $category
            ]);
        }
        // Se actualiza y se guardan cambios
        $this->game['name'] = $this->name;
        $this->game->save();
        //Se emite un evento
        $this->dispatch('editGame');
        session()->put('status', 'Juego editado correctamente.');
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
