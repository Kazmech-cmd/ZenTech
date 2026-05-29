<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $accId = Category::where('name', 'Аксессуары')->first()?->id;

        return view('welcome', [
            'categories' => Category::all(),
            'promoProducts' => Product::where('is_promo', true)->inRandomOrder()->take(4)->get(),
            'newProducts' => Product::where('is_new', true)->inRandomOrder()->take(4)->get(),
            'accessories' => Product::where('category_id', $accId)->take(4)->get(),
        ]);
    }

    public function showCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $query = Product::where('category_id', $id);

        // Фильтр по цене
        if ($request->filled('min_price'))
            $query->where('price', '>=', $request->min_price);
        if ($request->filled('max_price'))
            $query->where('price', '<=', $request->max_price);

        // Фильтр по бренду
        if ($request->filled('brand') && $request->brand !== 'Все бренды') {
            $query->where('name', 'like', '%' . $request->brand . '%');
        }

        // Фильтр по ПЗУ (ROM)
        if ($request->filled('rom')) {
            $query->where('name', 'like', '%' . $request->rom . '%');
        }

        // Сортировка
        if ($request->sort == 'price_asc')
            $query->orderBy('price', 'asc');
        elseif ($request->sort == 'price_desc')
            $query->orderBy('price', 'desc');
        else
            $query->latest();

        return view('category', [
            'category' => $category,
            'categories' => Category::all(),
            'products' => $query->get(),
        ]);
    }
}