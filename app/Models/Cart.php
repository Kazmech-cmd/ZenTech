<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Разрешаем массовое заполнение этих полей
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    /**
     * Связь с товаром (каждая запись в корзине принадлежит конкретному товару)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Связь с пользователем
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}