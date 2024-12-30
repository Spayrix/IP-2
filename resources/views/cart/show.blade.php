@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Shopping Cart</h1>

        @if($cartItems && count($cartItems) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->product->price * $item->quantity }}</td>
                        <td>
                            <!-- Sepetten Çıkarma Butonu -->
                            <form action="{{ route('cart.remove', $item->product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Sepet toplamı -->
            <h4>Total: ${{ $cartItems->sum(function($cartItem) { return $cartItem->product->price * $cartItem->quantity; }) }}</h4>

            <!-- Ödeme Butonu -->
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>

        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
