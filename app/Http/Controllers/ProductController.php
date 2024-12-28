<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        return response()->json($product);
    }
    public function category($id)
    {
        $category = Category::findOrFail($id); // İlgili kategoriyi bul
        $products = Product::where('category_id', $id)->get(); // O kategoriye ait ürünleri al

        return view('products.category', compact('category', 'products'));
    }
}
