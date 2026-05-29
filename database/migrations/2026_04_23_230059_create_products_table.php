<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        // Связь с категорией
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
        
        $table->string('name');
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();
        
        // Поля для главной страницы
        $table->boolean('is_promo')->default(false); // Акция
        $table->boolean('is_new')->default(false);   // Новинка
        
        $table->integer('stock')->default(0); // Количество в наличии
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
