<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function list(): View
    {
        session()->forget('status');
        return view('match.list');
    }
}
