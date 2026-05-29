<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Показать корзину
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Добавить в корзину
    public function add(Request $request, Product $product)
    {
        // 1. Ищем товар в корзине этого пользователя
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // 2. Если нашли — увеличиваем количество через метод модели
            $cartItem->increment('quantity');
        } else {
            // 3. Если нет — создаем новую запись
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Товар добавлен в Zen-корзину!');
    }

    public function remove(Cart $cartItem)
    {
        // Проверяем, что корзина принадлежит текущему пользователю
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return back()->with('success', 'Товар удален из корзины');
    }
}