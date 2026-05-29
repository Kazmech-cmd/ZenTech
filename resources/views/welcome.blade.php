<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZenTech Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9FBF4] text-gray-900 antialiased">

    <x-header :categories="$categories" />

    <main class="max-w-7xl mx-auto px-4 py-10">

        <div class="relative bg-zen-dark rounded-[3rem] overflow-hidden mb-16 shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-zen-dark via-transparent to-transparent z-10"></div>
            <div class="relative z-20 px-12 py-20 md:w-2/3">
                <span
                    class="inline-block bg-zen-green text-zen-dark text-xs font-black px-4 py-1.5 rounded-full mb-6 uppercase tracking-widest">
                    Эксклюзивно в Zentech
                </span>
                <h2 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6">
                    Твой идеальный <br> <span class="text-zen-base text-zen-green">Phystachio</span> стиль
                </h2>
                <p class="text-gray-300 text-lg mb-10 max-w-md leading-relaxed">
                    Мощные девайсы в уникальном цвете. Успей забрать свой iPhone 15 Pro Zen по специальной цене до конца недели.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-zen-base text-zen-dark px-8 py-4 rounded-2xl font-bold hover:bg-white transition-all transform hover:-translate-y-1 shadow-lg">
                        Купить сейчас
                    </a>
                    <a href="#"
                        class="border-2 border-white/20 text-white px-8 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all">
                        Подробнее
                    </a>
                </div>
            </div>
            <div class="absolute right-[-10%] top-1/2 -translate-y-1/2 w-1/2 h-full bg-zen-green/10 blur-[120px] rounded-full"></div>
        </div>

        <div class="flex justify-between items-end mb-8">
            <h1 class="text-3xl font-extrabold text-zen-dark uppercase tracking-tight">Акции и скидки</h1>
            <a href="#" class="text-zen-dark font-semibold border-b-2 border-zen-base hover:text-zen-green transition">Смотреть все</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
            @forelse($promoProducts as $product)
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-zen-light hover:shadow-xl transition-all duration-300 group">
                    <div class="bg-zen-light h-52 rounded-2xl mb-5 flex items-center justify-center relative overflow-hidden">
                        <span class="absolute top-4 left-4 bg-zen-dark text-white text-[10px] font-bold uppercase px-3 py-1 rounded-full shadow-lg z-10">Sale</span>
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                    <div class="flex justify-between items-center mt-auto">
                        <div>
                            <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-widest">Цена</span>
                            <span class="text-2xl font-black text-zen-dark">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                        </div>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-zen-base text-zen-dark p-3 rounded-2xl hover:bg-zen-dark hover:text-white transition-colors shadow-sm active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-10 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 font-medium">В этой секции пока пусто...</p>
                </div>
            @endforelse
        </div>

        <div class="flex justify-between items-end mb-8 mt-16">
            <h1 class="text-3xl font-extrabold text-zen-dark uppercase tracking-tight">Новинки</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
            @forelse($newProducts as $product)
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-zen-light hover:shadow-xl transition-all duration-300 group">
                    <div class="bg-zen-green/20 h-48 rounded-2xl mb-4 flex items-center justify-center relative overflow-hidden">
                        <span class="absolute top-4 left-4 text-zen-dark font-bold text-xs uppercase px-3 py-1 bg-white rounded-full shadow-sm z-10">New</span>
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xl font-black text-zen-dark">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                        <button class="bg-zen-light text-zen-dark p-2 rounded-xl hover:bg-zen-base transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Свежих поступлений пока нет...</p>
            @endforelse
        </div>

        <div class="flex justify-between items-end mb-8 mt-16">
            <h1 class="text-3xl font-extrabold text-zen-dark uppercase tracking-tight">Аксессуары</h1>
            <a href="#" class="text-gray-400 hover:text-zen-green transition text-sm font-bold uppercase">Все дополнения</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @forelse($accessories as $item)
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-zen-light hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
                    <div class="bg-gray-50 h-48 rounded-2xl mb-5 flex items-center justify-center border border-gray-100 relative overflow-hidden group-hover:bg-zen-light/50 transition">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                             class="w-full h-full object-contain p-4 group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2 leading-snug flex-grow">{{ $item->name }}</h3>
                    <p class="text-gray-400 text-xs mb-5 line-clamp-2">{{ $item->description }}</p>
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                        <span class="text-2xl font-black text-zen-dark tracking-tight">{{ number_format($item->price, 0, '.', ' ') }} ₽</span>
                        <button class="bg-zen-base text-zen-dark p-3 rounded-xl hover:bg-zen-dark hover:text-white transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-10 text-center bg-gray-50 rounded-3xl border border-gray-100">
                    <p class="text-gray-400">Аксессуары скоро в продаже...</p>
                </div>
            @endforelse
        </div>

    </main>

    <footer class="bg-white border-t border-zen-light mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-1">
                <a href="/" class="text-2xl font-bold text-zen-dark tracking-tighter">
                    ZEN<span class="text-zen-green">TECH</span>
                </a>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">Магазин электроники с душой.</p>
            </div>
            <div>
                <h4 class="font-bold text-zen-dark mb-4">Покупателям</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="#" class="hover:text-zen-green transition">Доставка</a></li>
                    <li><a href="#" class="hover:text-zen-green transition">Оплата</a></li>
                    <li><a href="#" class="hover:text-zen-green transition">Гарантия</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-zen-dark mb-4">О нас</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="#" class="hover:text-zen-green transition">Контакты</a></li>
                    <li><a href="#" class="hover:text-zen-green transition">Вакансии</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-zen-dark mb-4">Мы в соцсетях</h4>
                <div class="flex space-x-4 text-gray-400 font-bold">
                    <a href="#" class="hover:text-zen-dark transition">VK</a>
                    <a href="#" class="hover:text-zen-dark transition">TG</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-gray-100 text-center text-gray-400 text-xs">
            &copy; 2026 ZENTECH SHOP. Все права защищены.
        </div>
    </footer>

</body>
</html>