<x-app-layout>
    {{-- inline-стили для надежности, если CSS не прогрузится --}}
    <style>
        /* Сброс стандартных стилей кнопки, если Tailwind отвалится */
        .zen-submit-btn {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-xl mx-auto px-4">

            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-zen-dark uppercase tracking-tighter">Оплата заказа</h1>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Тестовый режим</p>
            </div>

            {{-- Карточка оплаты --}}
            <div
                class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-zen-light p-8 md:p-12 relative overflow-hidden">

                <form action="{{ route('order.process') }}" method="POST" class="space-y-6" autocomplete="off">
                    @csrf

                    {{-- Номер карты --}}
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3 ml-2">Номер карты</label>
                        <input type="text" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required
                            oninput="this.value = this.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim()"
                            class="w-full bg-gray-50 border border-zen-light rounded-2xl px-6 py-4 text-lg font-mono outline-none focus:border-zen-green focus:ring-1 focus:ring-zen-green transition-all">
                        @error('card_number') <p class="text-red-500 text-[10px] mt-1 ml-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Срок --}}
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3 ml-2">Срок
                                действия</label>
                            <input type="text" name="expiry" placeholder="MM/YY" maxlength="5" required
                                oninput="this.value = this.value.replace(/[^\d]/g, '').replace(/(.{2})/, '$1/').trim()"
                                class="w-full bg-gray-50 border border-zen-light rounded-2xl px-6 py-4 text-center outline-none focus:border-zen-green transition-all">
                            @error('expiry') <p class="text-red-500 text-[10px] mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- CVC --}}
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3 ml-2">CVC</label>
                            <input type="password" name="cvc" placeholder="***" maxlength="3" required
                                oninput="this.value = this.value.replace(/[^\d]/g, '')" {{-- Разрешаем только цифры --}}
                                class="w-full bg-gray-50 border border-zen-light rounded-2xl px-6 py-4 text-center outline-none focus:border-zen-green transition-all overflow-hidden">
                            @error('cvc') <p class="text-red-500 text-[10px] mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="submit" style="background-color: #1a1a1a; color: white;"
                        class="w-full font-black py-5 rounded-2xl hover:bg-zen-green hover:text-zen-dark transition-all duration-300 shadow-xl uppercase tracking-widest text-xs">
                        Подтвердить платеж
                    </button>
                </form>

                {{-- Декоративный круг (добавили pointer-events-none, чтобы не мешал кликам) --}}
                <div class="pointer-events-none absolute -top-12 -right-12 w-32 h-32 bg-zen-light/30 rounded-full">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>