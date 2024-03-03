<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Game;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Carga la vista correspondiente en base al rol 
     */
    public function list()
    {
        session()->forget('status');
        $users = User::all()->count();
        $genres = Genre::all()->count();
        $games = Game::all()->count();
        $categories = Category::all()->count();
        
        if (auth()->user()->rol == 'SUPERAD') {
            return view('dashboard.superad', compact('users', 'games', 'genres', 'categories'));
        } elseif (auth()->user()->rol == 'ADMIN') {
            return view('dashboard.admin', compact('users', 'games', 'genres', 'categories'));
        } else {
            return view('dashboard.usuarios');
        }
    }
}
