<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        // Ürünleri al
        $products = Product::all(); // Ya da belirli bir sorgu kullanabilirsiniz

        // View'e ürünleri gönder
        return view('home', compact('products'));
    }
}
