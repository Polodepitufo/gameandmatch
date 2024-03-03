<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    /**
     * Carga la vista correspondiente
     */
    public function list(): View
    {
        session()->forget('status');
        return view('search.list');
    }

    
    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     * En caso de que el $id no exista, te redirige a la página general de búsqueda de usuario
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            session()->forget('status');
            return view('search.show', compact('user'));
        } catch (\Exception $e) {
            return Redirect::to('search');
        };
    }
}
