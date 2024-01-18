<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Gameedit extends Component
{
    public $name = '';
    public $id = '';
    public $description = '';
    public $platform = '';
    public Game $game;
    public $genres_;
    public $categories_;
    protected function rules()
    {
        return [
            'name' => ['required', 'max:60', 'unique:' . Game::class],
            'description' => ['required', 'max:255'],
            'platform' => ['required']
        ];
    }

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

    public function render()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.gameedit', compact('genres', 'categories'));
    }
    public function update()
    {
        $this->resetValidation();
        $gameComprobar = Game::where('id', $this->game['id'])->get();
        foreach ($gameComprobar as $gam) {
            if ($gam->name != $this->name) {
                $this->validate();
            }
        }

        DB::table('game_genre')->where('id_game', $this->id)->delete();
        foreach ($this->genres_ as $genre) {
            DB::table("game_genre")->updateOrInsert([
                "id_game" => $this->id,
                "id_genre" => $genre
            ]);
        }


        DB::table('game_category')->where('id_game', $this->id)->delete();
        foreach ($this->categories_ as $category) {
            DB::table("game_category")->updateOrInsert([
                "id_game" => $this->id,
                "id_category" => $category
            ]);
        }

        $this->game['name'] = $this->name;
        $this->game->save();
        $this->dispatch('editGame');
        session()->put('status', 'Juego editado correctamente.');
    }

    public function deleteSession()
    {
        session()->forget('status');
    }
}
