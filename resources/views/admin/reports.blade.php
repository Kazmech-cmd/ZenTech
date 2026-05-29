<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                <div>
                    <h2 class="text-4xl font-black text-zen-dark uppercase tracking-tighter">
                        Финансовый <span class="text-zen-green">отчет</span>
                    </h2>
                    <p class="text-gray-400 font-medium mt-2">Мониторинг продаж и активности покупателей</p>
                </div>
                
                <div class="flex gap-4">
                    <button onclick="window.print()" class="bg-white border border-zen-light text-zen-dark px-6 py-3 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-gray-50 transition-all shadow-sm">
                        Печать отчета
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                {{-- Общая выручка --}}
                <div class="bg-zen-dark p-8 rounded-[2.5rem] shadow-xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <span class="text-zen-green text-[10px] font-bold uppercase tracking-[0.2em] block mb-2">Общая выручка</span>
                        <h3 class="text-3xl font-black text-white tracking-tight">
                            {{ number_format($totalRevenue, 0, '.', ' ') }} <span class="text-zen-green text-xl">₽</span>
                        </h3>
                    </div>
                    {{-- Декоративный круг на фоне --}}
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/5 rounded-full group-hover:scale-110 transition-transform"></div>
                </div>

                {{-- Количество заказов --}}
                <div class="bg-white border border-zen-light p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)]">
                    <span class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em] block mb-2">Всего заказов</span>
                    <h3 class="text-3xl font-black text-zen-dark tracking-tight">
                        {{ $orders->count() }} <span class="text-gray-300 text-xl uppercase">ед.</span>
                    </h3>
                </div>

                {{-- Средний чек --}}
                <div class="bg-white border border-zen-light p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)]">
                    <span class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em] block mb-2">Средний чек</span>
                    <h3 class="text-3xl font-black text-zen-dark tracking-tight">
                        {{ $orders->count() > 0 ? number_format($totalRevenue / $orders->count(), 0, '.', ' ') : 0 }} <span class="text-zen-green text-xl">₽</span>
                    </h3>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-zen-light overflow-hidden">
                <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="font-black text-zen-dark uppercase text-sm tracking-widest">История транзакций</h4>
                    <span class="text-[10px] font-bold text-zen-green bg-zen-green/10 px-4 py-1 rounded-full uppercase">Live данные</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID заказа</th>
                                <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Покупатель</th>
                                <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Дата платежа</th>
                                <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Итого</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-10 py-6 font-mono text-xs text-gray-400">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-zen-dark text-zen-green rounded-xl flex items-center justify-center font-black text-[10px]">
                                            {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-bold text-zen-dark text-sm">{{ $order->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-gray-500 text-sm font-medium">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <span class="font-black text-zen-dark">
                                        {{ number_format($order->total_price, 0, '.', ' ') }} ₽
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($orders->isEmpty())
                <div class="py-32 text-center">
                    <p class="text-gray-300 font-bold uppercase tracking-widest text-xs">Данные о продажах отсутствуют</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>