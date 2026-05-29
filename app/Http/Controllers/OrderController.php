<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function process(Request $request)
    {
        // 1. Валидация формата
        $request->validate([
            'card_number' => 'required|string|size:19',
            'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/'],
            'cvc' => 'required|string|size:3',
        ]);

        // 2. Проверка даты
        $expiry = $request->expiry;
        [$month, $year] = explode('/', $expiry);
        $expiryDate = Carbon::createFromFormat('m/y', $month . '/' . $year)->endOfMonth();

        if ($expiryDate->isPast()) {
            return back()->withErrors(['expiry' => 'Срок действия карты истек'])->withInput();
        }

        // ЛОГИКА СОХРАНЕНИЯ ДЛЯ ОТЧЕТА 

        // 3.  товары из корзины до удаления, чтобы посчитать сумму
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $totalPrice = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // 4. запись в таблицу заказов 
        Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'paid',
        ]);

        // 5. очистка корзины
        Cart::where('user_id', Auth::id())->delete();

        return view('order-success');
    }
}