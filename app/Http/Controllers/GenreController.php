<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GenreController extends Controller
{
    /**
     * Carga la vista correspondiente
     */
    public function list()
    {
        session()->forget('status');
        return view('genre.list');
    }


    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     * En caso de que el $id no exista, te redirige a la página general de géneros
     */
    public function show($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            session()->forget('status');
            return view('genre.show', compact('genre'));
        } catch (\Exception $e) {
            return Redirect::to('genre');
        };
    }
}
