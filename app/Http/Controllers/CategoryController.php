<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::with('products')->find($id);
        return response()->json($category);
    }
}
