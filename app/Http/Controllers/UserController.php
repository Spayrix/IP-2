<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Kullanıcı profili sayfası
    public function profile()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();
        $coupons = Coupon::all();

        return view('profile', compact('user', 'addresses', 'favorites', 'coupons'));
    }

    // Profil güncelleme
    public function updateProfile(Request $request)
    {
        $request->validate([
            'gender' => 'in:male,female,other',
            'age' => 'integer|min:0',
        ]);

        $user = Auth::user();
        $user->update($request->only(['gender', 'age']));

        return back()->with('success', 'Profile updated successfully!');
    }

    // Yeni adres ekleme
    public function storeAddress(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        Auth::user()->addresses()->create($request->all());

        return back()->with('success', 'Address added successfully!');
    }
}
