<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $getCat = function ($name) {
            return Category::firstOrCreate(['name' => $name])->id;
        };

        // --- 1. СМАРТФОНЫ (20 шт) ---
        $phoneModels = [
            'Apple' => ['iPhone 15 Pro', 'iPhone 15', 'iPhone 14'],
            'Samsung' => ['Galaxy S24 Ultra', 'Galaxy S23', 'Galaxy A54'],
            'Google' => ['Pixel 8 Pro', 'Pixel 7a'],
            'Xiaomi' => ['14 Ultra', 'Redmi Note 13 Pro']
        ];

        $catIdPhones = $getCat('Смартфоны');

        for ($i = 1; $i <= 20; $i++) {
            $brand = array_rand($phoneModels);
            $model = $phoneModels[$brand][array_rand($phoneModels[$brand])];
            $rom = [128, 256, 512][rand(0, 2)];

            Product::create([
                'name' => "$model $rom ГБ",
                'description' => "Смартфон от $brand. Память: $rom ГБ. Отличный дисплей и производительность.",
                'price' => rand(35000, 150000),
                'category_id' => $catIdPhones,
                'image' => "https://placehold.jp/24/374151/ffffff/600x600.png?text=" . urlencode($model),
                'is_new' => $i <= 5,
                'is_promo' => $i > 15,
            ]);
        }

        // --- 2. НОУТБУКИ (20 шт) ---
        $laptopModels = [
            'Apple' => ['MacBook Air M3', 'MacBook Pro 14'],
            'ASUS' => ['ROG Zephyrus', 'Zenbook S13'],
            'HP' => ['Spectre x360', 'Victus 16'],
            'Lenovo' => ['ThinkPad X1', 'Legion 5']
        ];
        $catIdLaptops = $getCat('Ноутбуки');

        for ($i = 1; $i <= 20; $i++) {
            $brand = array_rand($laptopModels);
            $model = $laptopModels[$brand][array_rand($laptopModels[$brand])];
            $rom = [256, 512, 1024][rand(0, 2)];

            Product::create([
                'name' => "$model ($brand) $rom ГБ",
                'description' => "Ноутбук для профессионалов. Накопитель: $rom ГБ SSD. Компактный и мощный.",
                'price' => rand(60000, 300000),
                'category_id' => $catIdLaptops,
                'image' => "https://placehold.jp/24/374151/ffffff/600x600.png?text=" . urlencode($model),
                'is_new' => $i <= 5,
                'is_promo' => rand(0, 1),
            ]);
        }

        // --- 3. ПЛАНШЕТЫ (20 шт) ---
        $tabletModels = [
            'Apple' => ['iPad Pro 11', 'iPad Air'],
            'Samsung' => ['Galaxy Tab S9', 'Galaxy Tab A9'],
            'Huawei' => ['MatePad Pro', 'MatePad 11']
        ];
        $catIdTablets = $getCat('Планшеты');

        for ($i = 1; $i <= 20; $i++) {
            $brand = array_rand($tabletModels);
            $model = $tabletModels[$brand][array_rand($tabletModels[$brand])];
            $rom = [64, 128, 256][rand(0, 2)];

            Product::create([
                'name' => "$model $rom ГБ WiFi",
                'description' => "Планшет $brand. Встроенная память: $rom ГБ. Тонкий корпус.",
                'price' => rand(25000, 140000),
                'category_id' => $catIdTablets,
                'image' => "https://placehold.jp/24/374151/ffffff/600x600.png?text=" . urlencode($model),
                'is_new' => rand(0, 1),
                'is_promo' => $i > 10,
            ]);
        }

        // --- 4. АКСЕССУАРЫ (20 шт) ---
        $accModels = [
            'Sony' => ['WH-1000XM5', 'WF-1000XM5'],
            'Apple' => ['AirPods Pro 2', 'Apple Watch 9'],
            'Logitech' => ['MX Master 3S', 'G Pro X Keyboard'],
            'JBL' => ['Charge 5', 'Flip 6']
        ];
        $catIdAcc = $getCat('Аксессуары');

        for ($i = 1; $i <= 20; $i++) {
            $brand = array_rand($accModels);
            $model = $accModels[$brand][array_rand($accModels[$brand])];

            Product::create([
                'name' => $model,
                'description' => "Аксессуар от $brand. Качество и стиль.",
                'price' => rand(5000, 45000),
                'category_id' => $catIdAcc,
                'image' => "https://placehold.jp/24/374151/ffffff/600x600.png?text=" . urlencode($model),
                'is_new' => $i % 3 == 0,
                'is_promo' => $i % 4 == 0,
            ]);
        }
    }
}