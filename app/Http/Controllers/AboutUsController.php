<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first(); // İlk AboutUs kaydını getir
        return view('about', compact('aboutUs'));
    }
}
