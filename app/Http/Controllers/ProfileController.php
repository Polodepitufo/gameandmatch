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
    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     */
    public function show(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Actualiza los datos de perfil del usuario
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina el perfil del usuario
     */
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

    /**
     * Reestablece los unmatches del usuario
     */
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
     * Cierra la sesión
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
