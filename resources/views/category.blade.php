<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} | ZenTech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9FBF4] text-gray-900 antialiased">

    <x-header :categories="$categories" />

    <main class="max-w-7xl mx-auto px-4 py-10">
        <nav class="text-sm text-gray-400 mb-4 font-medium uppercase tracking-widest">
            <a href="/" class="hover:text-zen-green">Главная</a> / {{ $category->name }}
        </nav>

        <div class="flex flex-col md:flex-row gap-10">
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-zen-light sticky top-24">
                    <h2 class="text-xl font-black text-zen-dark mb-6 uppercase tracking-tight">Фильтры</h2>

                    <form action="{{ route('category.show', $category->id) }}" method="GET" class="space-y-6">

                        {{-- Блок Цены --}}
                        <div>
                            <h4 class="font-bold text-xs text-gray-400 mb-3 uppercase tracking-widest">Цена, ₽</h4>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                    placeholder="От"
                                    class="w-1/2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-zen-base">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                    placeholder="До"
                                    class="w-1/2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-zen-base">
                            </div>
                        </div>

                        {{-- Блок Бренда --}}
                        <div class="relative"
                            x-data="{ open: false, selected: '{{ request('brand') ? ucfirst(request('brand')) : 'Все бренды' }}' }">
                            <h4 class="font-bold text-xs text-gray-400 mb-3 uppercase tracking-widest">Бренд</h4>
                            <button type="button" @click="open = !open"
                                class="w-full bg-gray-50 border-none rounded-xl text-sm px-4 py-3 flex items-center justify-between hover:bg-zen-light transition-all">
                                <span x-text="selected" class="text-gray-700"></span>
                                <svg class="w-4 h-4 text-zen-green transition-transform"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-50 w-full mt-2 bg-white rounded-[1.5rem] shadow-xl border border-zen-light overflow-hidden p-2">
                                @foreach(['Все бренды', 'Apple', 'Samsung', 'Xiaomi', 'Google', 'Huawei'] as $brand)
                                    <div @click="selected = '{{ $brand }}'; open = false; $refs.brandInput.value = '{{ $brand == 'Все бренды' ? '' : $brand }}'"
                                        class="px-4 py-2 text-sm rounded-xl cursor-pointer hover:bg-zen-light transition-colors">
                                        {{ $brand }}
                                    </div>
                                @endforeach
                            </div>
                            {{-- Важно: убрали strtolower, так как контроллер сам всё приведет к регистру --}}
                            <input type="hidden" name="brand" x-ref="brandInput" value="{{ request('brand') }}">
                        </div>

                        <hr class="border-zen-light">

                        {{-- Блок ПЗУ (ОЗУ УДАЛЕНО) --}}
                        @if(in_array($category->name, ['Смартфоны', 'Планшеты', 'Ноутбуки']))
                            <div class="space-y-4">
                                <div class="relative"
                                    x-data="{ open: false, selected: '{{ request('rom') ? request('rom') . ' ГБ' : 'Объем памяти' }}' }">
                                    <h4 class="font-bold text-xs text-gray-400 mb-3 uppercase tracking-widest">Память</h4>
                                    <button type="button" @click="open = !open"
                                        class="w-full bg-gray-50 border-none rounded-xl text-sm px-4 py-3 flex items-center justify-between hover:bg-zen-light transition-all">
                                        <span x-text="selected"></span>
                                        <svg class="w-4 h-4 text-zen-green transition-transform"
                                            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute z-50 w-full mt-2 bg-white rounded-[1.5rem] shadow-xl border border-zen-light p-2">
                                        <div @click="selected = 'Все'; open = false; $refs.romInp.value = ''"
                                             class="px-4 py-2 text-sm rounded-xl hover:bg-zen-light cursor-pointer">Все</div>
                                        @foreach(['128', '256', '512', '1024'] as $v)
                                            <div @click="selected = '{{ $v }} ГБ'; open = false; $refs.romInp.value = '{{ $v }}'"
                                                class="px-4 py-2 text-sm rounded-xl hover:bg-zen-light cursor-pointer">{{ $v }} ГБ</div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="rom" x-ref="romInp" value="{{ request('rom') }}">
                                </div>
                            </div>
                        @endif

                        <button type="submit"
                            class="w-full bg-zen-dark text-white font-bold py-4 rounded-2xl hover:bg-zen-green hover:text-zen-dark transition-all duration-300 shadow-md active:scale-95 uppercase text-xs tracking-widest">
                            Применить
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-grow">
                <h1 class="text-4xl font-extrabold text-zen-dark uppercase tracking-tight mb-8">{{ $category->name }}</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-zen-light hover:shadow-xl transition-all duration-300 group flex flex-col">
                            <div class="bg-zen-light h-48 rounded-2xl mb-5 flex items-center justify-center relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ str_contains($product->image, 'http') ? $product->image : asset('storage/' . str_replace('\\', '/', $product->image)) }}"
                                        class="w-full h-full object-contain p-4 group-hover:scale-105 transition duration-500"
                                        alt="{{ $product->name }}">
                                @else
                                    <svg class="w-16 h-16 text-zen-dark opacity-10 group-hover:scale-110 transition duration-500"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-lg text-gray-800 mb-2 leading-tight">{{ $product->name }}</h3>
                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-xl font-black text-zen-dark">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                                <button class="bg-zen-base text-zen-dark p-2.5 rounded-xl hover:bg-zen-dark hover:text-white transition shadow-sm active:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border border-zen-light shadow-sm">
                            <svg class="w-20 h-20 text-zen-light mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-gray-400 text-lg">В этой категории пока нет подходящих товаров.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

</body>
</html>