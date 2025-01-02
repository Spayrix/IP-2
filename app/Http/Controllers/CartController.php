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


        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view your cart.');
        }

        $cartItems = $user->cartItems;
        return view('cart.show', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();


        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to add items to your cart.');
        }

        $product = Product::findOrFail($productId);


        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            $cart[$product->id]['quantity']++;
        } else {

            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }


        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();


        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {

            $cartItem->delete();
            return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in your cart.');
    }
}
