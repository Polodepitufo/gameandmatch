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
    public $name = '';
    public $background;
    public $description = '';
    public $photo;
    public $genres_;
    public $categories_;
    public $platform = 'STEAM';

    protected $rules = [
        'name' => ['required', 'string', 'max:60', 'unique:' . Game::class],
        'description' => ['required', 'max:255'],
        'platform' => ['required']

    ];

    public function render()
    {

        $genres = Genre::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        return view('livewire.gameform', compact('genres', 'categories'));
    }

    public function create()
    {

        $this->validate();
        $background = str_replace(' ', '-', strtolower($this->name)) . '.png';
        $this->background = $background;
        $gameCreado = Game::create(
            $this->only(['name', 'background', 'description', 'platform'])
        );

        if(!empty($this->genres_)){

            foreach ($this->genres_ as $genre) {
                DB::table("game_genre")->insert([
                    "id_game" => $gameCreado->id,
                    "id_genre" => $genre
                ]);
            }
        }

        if(!empty($this->categories_)){

        foreach ($this->categories_ as $category) {
            DB::table("game_category")->insert([
                "id_game" => $gameCreado->id,
                "id_category" => $category
            ]);
        }
    }

        session()->put('status', 'Juego añadido correctamente.');
    }
    public function deleteSession()
    {
        session()->forget('status');
    }
}
