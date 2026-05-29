<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-24 text-center">
        <div class="w-24 h-24 bg-zen-green/20 rounded-full flex items-center justify-center mx-auto mb-8">
            <span class="text-4xl">✨</span>
        </div>
        <h1 class="text-5xl font-black text-zen-dark uppercase mb-4 tracking-tighter">Заказ оплачен!</h1>
        <p class="text-gray-500 text-lg mb-12">Спасибо за покупку. Менеджер свяжется с вами в ближайшее время.</p>
        
        <a href="{{ route('home') }}" class="inline-block bg-zen-dark text-white px-12 py-5 rounded-2xl font-bold hover:bg-zen-green hover:text-zen-dark transition-all uppercase text-xs tracking-widest">
            Вернуться в магазин
        </a>
    </div>
</x-app-layout>