<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Добавь 'stock' в fillable, если планируешь его использовать
    protected $fillable = ['category_id', 'name', 'description', 'price', 'image', 'is_promo', 'is_new', 'stock'];

    /**
     * Связь с категорией (ОБЯЗАТЕЛЬНО для работы админки)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}