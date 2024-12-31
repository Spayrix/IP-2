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

        // Eğer kullanıcı yoksa, sepeti göstermek mümkün olmaz
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view your cart.');
        }

        $cartItems = $user->cartItems; // Kullanıcıya ait sepet ürünlerini al
        return view('cart.show', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();

        // Kullanıcı giriş yapmamışsa yönlendirme
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to add items to your cart.');
        }

        $product = Product::findOrFail($productId);

        // Eğer session'a sepete ürün ekliyorsanız:
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // Sepette ürün varsa miktarı artır
            $cart[$product->id]['quantity']++;
        } else {
            // Sepette ürün yoksa yeni ekle
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }

        // Sepeti session'a kaydet
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();

        // Sepetteki ürünü bul
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Ürünü sil
            $cartItem->delete();
            return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in your cart.');
    }
}
