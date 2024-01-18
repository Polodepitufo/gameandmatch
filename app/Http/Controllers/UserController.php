<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;



class UserController extends Controller
{
     /**
     * Display the user's profile form.
     */
    public function list(): View
    {
        session()->forget('status');
        return view('user.list');
    }

}
