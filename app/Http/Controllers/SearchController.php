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
    public function list(): View
    {
        session()->forget('status');
        return view('search.list');
    }
    public function show($id)
    {
        try {
            $user=User::find($id);

            if (!$user) {
                Auth::logout();
                return Redirect::to('/');
            } else {
                session()->forget('status');
                return view('search.show', compact('user'));
            }
        } catch (\Exception $e) {
            Auth::logout();
            return Redirect::to('/');
        };
    }
}
