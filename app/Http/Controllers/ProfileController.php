<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        try {
            $user = $request->user();
            DB::table('user_game')->where('id_user', Auth::id())->delete();
            $user->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Auth::logout();
            return Redirect::to('/')->with('status', 'profile-deleted');
        } catch (\Exception $e) {
            session()->put('status', 'No puedes eliminar tu cuenta.');
        };
    }
    public function unmatches(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        try {
            DB::table('user_game')->where('id_user', Auth::id())->where('match', 'NO')->delete();
            return Redirect::route('profile.edit')->with('status', 'unmatch');
        } catch (\Exception $e) {
            session()->put('status', 'Error al deshacer los unmatches.');
        };
    }
    /**
     * Cerrar sesión
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
