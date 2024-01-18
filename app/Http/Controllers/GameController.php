<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GameController extends Controller
{
        /**
        * Display the games.
        */
       public function list(): View
       {
           session()->forget('status');
           return view('game.list');
       }
       public function show($id)
       {
           session()->forget('status');
           $game = Game::findOrFail($id);
           return view('game.show', compact('game'));
       }
   
}
