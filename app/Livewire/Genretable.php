<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Genretable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    #[On('editGenre')]
    #[On('search')]
    public function render()
    {
        if($this->search !=''){
            $this->resetPage();
        }
        $genres = Genre::where('name', 'like', '%' . $this->search . '%')->simplePaginate(6);
        $this->dispatch('search');
        return view('livewire.genretable', compact('genres'));
    }

    public function delete($id)
    {
        try {
            Genre::where('id', $id)->delete();
            session()->put('status', 'Genero eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar un género que ya ha sido vinculado.');
        };
    }
    public function deleteSession()
    {
        session()->forget('status');
    }
}
