<?php

namespace App\Http\Controllers\Admin; // Должно быть в точности так

use App\Http\Controllers\Controller;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        $totalRevenue = $orders->sum('total_price');
        
        return view('admin.reports', compact('orders', 'totalRevenue'));
    }
}