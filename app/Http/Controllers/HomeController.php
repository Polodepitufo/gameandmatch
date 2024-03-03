<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Invoca el controlador para mostrar la vista correspondiente
     */
    public function __invoke()
    {
        return view('home');
    }
}
