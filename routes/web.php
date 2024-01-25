<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\MatchController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Tests\Feature\Auth\PasswordUpdateTest;

/*
|--------------------------------------------------------------------------
| Ruta home
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('index');

/*
|--------------------------------------------------------------------------
| Rutas para superAdmin
|--------------------------------------------------------------------------
*/
Route::middleware('isSuperAd')->group(function () {

    Route::get('/user', [UserController::class, 'list'])->name('user.list');
});
/*
|--------------------------------------------------------------------------
| Ruta para superAdmin y admin
|--------------------------------------------------------------------------
*/
Route::middleware('isAdminAndSuperAd')->group(function () {

    Route::get('/genre', [GenreController::class, 'list'])->name('genre.list');
    Route::get('/genre/{id}', [GenreController::class, 'show'])->name('genre.show');

    Route::get('/game', [GameController::class, 'list'])->name('game.list');
    Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');

    Route::get('/category', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
});

/*
|--------------------------------------------------------------------------
| Rutas autenticadas comúnes para superADmin, admin y usuario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {


    Route::get('/library', [LibraryController::class, 'list'])->name('library.list');
    Route::get('/match', [MatchController::class, 'list'])->name('match.list');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/unmatches', [ProfileController::class, 'unmatches'])->name('profile.unmatches');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

require __DIR__ . '/auth.php';

