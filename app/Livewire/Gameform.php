<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Gameform extends Component
{

    use WithFileUploads;
    //Propiedades públicas
    public $name = '';
    public $background;
    public $description = '';
    public $photo;
    public $genres_;
    public $categories_;
    public $platform = 'STEAM';
    //Reglas de validación
    protected $rules = [
        'name' => ['required', 'string', 'max:60', 'unique:' . Game::class],
        'description' => ['required', 'max:255'],
        'platform' => ['required']
    ];

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.gameform', compact('genres', 'categories'));
    }

    /**
     * Crea un nuevo elemento
     */
    public function create()
    {
        //Se validan los datos según las reglas definidas
        $this->validate();
        //Se transforma la variable background para que coincida con un formato de imagen
        $background = str_replace(' ', '-', strtolower($this->name)) . '.png';
        $this->background = $background;
        // Se crea un nuevo juego
        $gameCreado = Game::create(
            $this->only(['name', 'background', 'description', 'platform'])
        );

        //Si se marcan géneros, se insertan en la tabla game_genre
        if (!empty($this->genres_)) {

            foreach ($this->genres_ as $genre) {
                DB::table("game_genre")->insert([
                    "id_game" => $gameCreado->id,
                    "id_genre" => $genre
                ]);
            }
        }
        //Si se marcan categorias, se insertan en la tabla game_category
        if (!empty($this->categories_)) {

            foreach ($this->categories_ as $category) {
                DB::table("game_category")->insert([
                    "id_game" => $gameCreado->id,
                    "id_category" => $category
                ]);
            }
        }

        session()->put('status', 'Juego añadido correctamente.');
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
