<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Libraryedit extends Component
{

    public $id;
    public $puntuation;
    public $valoration;
    public function render()
    {
        return view('livewire.libraryedit');
    }

    public function mount($id,$puntuation,$valoration)
    {
        $this->id = $id;
        $this->puntuation = $puntuation;
        $this->valoration=$valoration;
    }
    protected $rules = [
        'valoration' => ['max:255'],
        'puntuation' => ['numeric','between:0,10']

    ];
    public function update()
    {
        $this->resetValidation();
        $this->validate();
        DB::table('user_game')
        ->where('id', $this->id)
        ->update(['valoration' => $this->valoration,'puntuation'=>$this->puntuation]);

        $this->dispatch('editValoration');
         session()->put('status', 'Valoración y puntuación editadas correctamente.');
    }

    public function deleteSession(){
        session()->forget('status');
    }
}
