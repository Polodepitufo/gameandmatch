<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GenreController extends Controller
{
    public function list()
    {
        session()->forget('status');
        return view('genre.list');
    }
    public function show($id)
    {
        session()->forget('status');
        $genre = Genre::findOrFail($id);
        return view('genre.show', compact('genre'));
    }

}
