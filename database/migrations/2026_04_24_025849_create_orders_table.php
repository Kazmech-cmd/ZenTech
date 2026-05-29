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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // ID пользователя, который сделал заказ
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Итоговая сумма заказа
        $table->decimal('total_price', 10, 2);
        
        // Статус (по умолчанию 'paid' — оплачен, раз у нас имитация оплаты)
        $table->string('status')->default('paid');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
