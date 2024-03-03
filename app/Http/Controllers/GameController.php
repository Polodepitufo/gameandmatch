<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /**
     * Carga la vista correspondiente
     */
    public function list(): View
    {
        session()->forget('status');
        return view('game.list');
    }


    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     * En caso de que el $id no exista, te redirige a la página general de juegos
     */
    public function show($id)
    {
        try {
            $game = Game::findOrFail($id);
            session()->forget('status');
            return view('game.show', compact('game'));
        } catch (\Exception $e) {
            return Redirect::to('category');
        };
    }
}
