<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Categorytable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    #[On('editCategory')]
    #[On('search')]
    public function render()
    {
        if($this->search !=''){
            $this->resetPage();
        }
        $categories = Category::where('name', 'like', '%' . $this->search . '%')->simplePaginate(6);
        $this->dispatch('search');
        return view('livewire.categorytable', compact('categories'));
    }

    public function delete($id)

    {
        try {
            Category::where('id', $id)->delete();
            session()->put('status', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar una categoría que ya ha sido vinculada.');
        };
    }

    public function deleteSession(){
        session()->forget('status');
    }
}
