<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Usertable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    #[On('search')]
    public function render()
    {
        if (Auth::check()) {
            $users = User::where('nick', 'like', '%' . $this->search . '%')->whereNot('nick', Auth::user()->nick)->simplePaginate(6);
        } else {
            $users = User::where('nick', 'like', '%' . $this->search . '%')->simplePaginate(6);
        }
        $this->dispatch('search');
        return view('livewire.usertable', compact('users'));
    }

    public function rol($id)
    {
        $user = User::where('id', $id)->get();
        foreach ($user as $u) {
            if ($u->rol == 'ADMIN') {
                $u->rol = 'USUARIO';
            } elseif ($u->rol == 'USUARIO') {
                $u->rol = 'ADMIN';
            }
            $u->save();
        }
        session()->put('status', 'Rol editado correctamente.');
    }

    public function delete($id)
    {

        try {
            User::where('id', $id)->delete();
            session()->put('status', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar un usuario que ya ha sido vinculado.');
        };
    }

    public function deleteSession()
    {
        session()->forget('status');
    }
}
