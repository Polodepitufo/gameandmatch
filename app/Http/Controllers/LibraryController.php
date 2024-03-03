<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LibraryController extends Controller
{
    /**
     * Carga la vista correspondiente
     */
    public function list(): View
    {
        session()->forget('status');
        return view('library.list');
    }

    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     * En caso de que el $id no exista, te redirige a la página general de biblioteca
     */
    public function show($id)
    {
        try {
            $game = DB::table('user_game')->where('id', $id)->first();

            if (Auth::id() === $game->id_user) {
                session()->forget('status');
                return view('library.show', compact('game'));
            }
        } catch (\Exception $e) {
            return Redirect::to('library');
        };
    }
}
