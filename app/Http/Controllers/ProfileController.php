<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show()
    {
        // Kullanıcının profilini göstermek
        $user = Auth::user();
        $addresses = $user->addresses; // Kullanıcının adreslerini al
        return view('profile.show', compact('user', 'addresses'));
    }

    public function updateProfile(Request $request)
    {
        // Kullanıcının verilerini güncellemek
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Verileri güncelle
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->gender = $validated['gender'];
        $user->age = $validated['age'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Şifre değişikliği varsa
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updateAvatar(Request $request)
    {
        // Avatar güncelleme işlemi
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = Auth::user();
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Avatar updated successfully!');
    }
}
