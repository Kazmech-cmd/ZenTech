<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-zen-light p-10 md:p-16">

                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-4xl font-black text-zen-dark uppercase tracking-tighter">
                            Ваша <span class="text-zen-green">корзина</span>
                        </h2>
                        <p class="text-gray-400 font-medium mt-2">
                            Проверьте выбранную технику перед заказом
                        </p>
                    </div>

                    <a href="/"
                        class="text-xs font-bold text-gray-400 hover:text-zen-dark transition-colors uppercase tracking-widest pb-2">
                        Вернуться в магазин
                    </a>
                </div>

                @if($cartItems->count() > 0)
                    <div class="space-y-6">

                        @foreach($cartItems as $item)
                            <div
                                class="flex items-center gap-8 p-6 bg-gray-50 rounded-[2rem] border border-transparent hover:border-zen-light transition-all">

                                <div
                                    class="w-24 h-24 bg-white rounded-2xl overflow-hidden flex items-center justify-center shadow-sm">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/150'">
                                </div>

                                <div class="flex-1">
                                    <h4 class="text-lg font-black text-zen-dark uppercase">
                                        {{ $item->product->name }}
                                    </h4>
                                    <p class="text-zen-green font-bold">
                                        {{ number_format($item->product->price, 0, '.', ' ') }} ₽
                                    </p>
                                </div>

                                <div class="flex items-center gap-6">
                                    <div class="bg-white px-4 py-2 rounded-xl shadow-sm text-sm font-black text-zen-dark">
                                        {{ $item->quantity }} шт.
                                    </div>

                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="text-right min-w-[120px]">
                                    <p class="text-xl font-black text-zen-dark">
                                        {{ number_format($item->product->price * $item->quantity, 0, '.', ' ') }} ₽
                                    </p>
                                </div>

                            </div>
                        @endforeach

                        <div class="mt-12 pt-10 border-t border-gray-100 flex flex-col items-end">
                            <p class="text-gray-400 uppercase tracking-[0.2em] text-[10px] font-bold mb-2">
                                Общая стоимость
                            </p>

                            <div class="text-5xl font-black text-zen-dark tracking-tighter">
                                {{ number_format($total, 0, '.', ' ') }}
                                <span class="text-zen-green">₽</span>
                            </div>

                            {{-- ИСПРАВЛЕНО: Теперь это ссылка на оформление заказа --}}
                            <a href="{{ route('checkout') }}"
                                class="mt-10 inline-block w-full md:w-auto bg-zen-dark text-white px-12 py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-zen-green hover:text-zen-dark transition-all shadow-xl active:scale-95 text-center">
                                Оформить заказ
                            </a>
                        </div>

                    </div>
                @else
                    <div class="text-center py-20">
                        <div class="mb-8 opacity-10 flex justify-center">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 120px; height: 120px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z">
                                </path>
                            </svg>
                        </div>

                        <p class="text-gray-400 font-black uppercase tracking-[0.2em] text-sm">
                            В корзине пока пусто
                        </p>

                        <a href="/"
                            class="inline-block mt-8 bg-zen-dark text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-zen-green hover:text-zen-dark transition-all shadow-lg active:scale-95">
                            Начать покупки
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>