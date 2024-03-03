<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Carga la vista correspondiente
     */
    public function list()
    {
        session()->forget('status');
        return view('category.list');
    }

    /**
     * Muestra la información relacionada con el $id que entra como parametro
     * Carga la vista correspondiente
     * En caso de que el $id no exista, te redirige a la página general de categorias
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            session()->forget('status');
            return view('category.show', compact('category'));
        } catch (\Exception $e) {
            return Redirect::to('category');
        };
    }
}
