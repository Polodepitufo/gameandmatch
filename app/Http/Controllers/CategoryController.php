<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        session()->forget('status');
        return view('category.list');
    }
    public function show($id)
    {
        session()->forget('status');
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }
}
