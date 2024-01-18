<?php

namespace App\Livewire;

use App\Http\Requests\genreEditRequest;
use App\Models\Genre;
use Livewire\Attributes\On;
use Livewire\Component;

class Genreedit extends Component
{
    public $name = '';
    public Genre $genre;

    protected function rules()
    {
        return [
            'name' => ['required','max:60', 'unique:' . Genre::class],
        ];
    }
    public function mount(Genre $genre)
    {
        $this->name = $genre->name;
        $this->genre = $genre;
    }

    public function render()
    {
        return view('livewire.genreedit');
    }
    
    public function update()
    {
        $this->resetValidation();
        $genreComprobar = Genre::where('id', $this->genre['id'])->get();
        foreach ($genreComprobar as $gen) {

            if ($gen->name != $this->name) {
                $this->validate();
            }
        }
        $this->genre['name'] = $this->name;
        $this->genre->save();
        $this->dispatch('editGenre');
        session()->put('status', 'Género editado correctamente.');
    }
    public function deleteSession(){
        session()->forget('status');
    }
}
