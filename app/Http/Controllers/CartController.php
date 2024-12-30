<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems; // Kullanıcıya ait sepet ürünlerini al

        return view('cart.show', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Sepette ürün varsa miktarı artır
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Sepette ürün yoksa yeni bir öğe ekle
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.show');
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.show');
    }
}
