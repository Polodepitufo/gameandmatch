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
use App\Http\Controllers\SearchController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Tests\Feature\Auth\PasswordUpdateTest;
/*
|--------------------------------------------------------------------------
| Anotaciones generales del proyecto:
| - Se dejan por defecto los comentarios en inglés en las funciones que proporciona laravel.
| - En cada controlador borramos la sesión para que no persista el mensaje emergente.
| - En las request se añade el nick
| - En Http/Kernel se añaden los alias de los middlewares
| - Se deja principalmente comentado: controladores y controladores de livewire. Modelos. Middlewares creados. Test unitarios. 
|--------------------------------------------------------------------------
*/

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


    Route::get('/library/{id}', [LibraryController::class, 'show'])->name('library.show');
    Route::get('/library', [LibraryController::class, 'list'])->name('library.list');

    Route::get('/match', [MatchController::class, 'list'])->name('match.list');

    Route::get('/search', [SearchController::class, 'list'])->name('search.list');
    Route::get('/search/{id}', [SearchController::class, 'show'])->name('search.show');
    
    Route::get('/dashboard', [DashboardController::class, 'list'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/unmatches', [ProfileController::class, 'unmatches'])->name('profile.unmatches');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

require __DIR__ . '/auth.php';

