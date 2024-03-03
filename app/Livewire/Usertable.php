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
    //Propiedades públicas
    public $search = '';

    //Se manejan los eventos
    #[On('search')]
    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        //Verifica si el usuario está autenticado. Se aplica por si el usuario cierra su sesión en esta misma vista. En caso contrario el nombre apareceria durante el tiempo que tarde la sesión en cerrarse
        //Búsqueda con filtro y paginación
        if (Auth::check()) {
            $users = User::where('nick', 'like', '%' . $this->search . '%')->whereNot('nick', Auth::user()->nick)->simplePaginate(6);
        } else {
            $users = User::where('nick', 'like', '%' . $this->search . '%')->simplePaginate(6);
        }
        //Se emite un evento
        $this->dispatch('search');
        return view('livewire.usertable', compact('users'));
    }
    /**
     * Cambia el rol de los usuarios a admin o usuario
     */
    public function rol($id)
    {
        //Obtiene el usuario con el ID proporcionado
        $user = User::where('id', $id)->get();
        foreach ($user as $u) {
            // Verifica el rol actual del usuario y realiza un cambio
            if ($u->rol == 'ADMIN') {
                $u->rol = 'USUARIO';
            } elseif ($u->rol == 'USUARIO') {
                $u->rol = 'ADMIN';
            }
            //Se guarda
            $u->save();
        }
        session()->put('status', 'Rol editado correctamente.');
    }

    /**
     * Elimina el elemento en base al id que entra.
     * En caso de que el elemento esté relacionado, se envía un mensaje informativo
     */
    public function delete($id)
    {
        try {
            User::where('id', $id)->delete();
            session()->put('status', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar un usuario que ya ha sido vinculado.');
        };
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
