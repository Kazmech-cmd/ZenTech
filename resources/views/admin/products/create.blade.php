<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <div class="mb-8">
            <a href="{{ route('admin.products.index') }}"
                class="text-zen-dark opacity-50 hover:opacity-100 transition font-bold uppercase text-xs">
                ← Назад к списку
            </a>
            <h1 class="text-3xl font-black text-zen-dark uppercase mt-2">Новый товар</h1>
        </div>

        <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-zen-light">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Название</label>
                    <input type="text" name="name" required
                        class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 focus:ring-2 focus:ring-zen-green outline-none">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Категория</label>
                        <select name="category_id"
                            class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Цена (₽)</label>
                        <input type="number" name="price" required
                            class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Категория</label>
                    <div class="relative"> {{-- Обертка для кастомной стрелочки --}}
                        <select name="category_id"
                            class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none appearance-none focus:ring-2 focus:ring-zen-green">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        {{-- Кастомная стрелочка справа --}}
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Фото товара</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500">
                </div>

                <button type="submit"
                    class="w-full bg-zen-dark text-white font-bold py-5 rounded-2xl hover:bg-zen-green hover:text-zen-dark transition shadow-lg uppercase tracking-widest text-xs">
                    Создать и опубликовать
                </button>
            </form>
        </div>
    </div>
</x-app-layout>