<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LibraryController extends Controller
{
    public function list(): View
    {
        session()->forget('status');
        return view('library.list');
    }
    public function show($id)
    {
        try {
            $game = DB::table('user_game')->where('id', $id)->first();;

            if (Auth::id() != $game->id_user) {
                Auth::logout();
                return Redirect::to('/');
            } else {
                session()->forget('status');
                return view('library.show', compact('game'));
            }
        } catch (\Exception $e) {
            Auth::logout();
            return Redirect::to('/');
        };
    }
}
