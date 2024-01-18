<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Gametable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    #[On('editGame')]
    #[On('search')]
    public function render()
    {

        if($this->search !=''){
            $this->resetPage();
        }
        $games = Game::where('name', 'like', '%' . $this->search . '%')->with(['genres'])->simplePaginate(6);

        $this->dispatch('search');
        return view('livewire.gametable', compact('games'));
    }

    public function delete($id)
    {
        try {
            Game::where('id', $id)->delete();
            DB::table('game_genre')->where('id_game', $id)->delete();
            DB::table('game_category')->where('id_game', $id)->delete();
            
            session()->put('status', 'Juego eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar una juego que ya ha sido vinculado.');
        };
    }
    public function deleteSession()
    {
        session()->forget('status');
    }
}
