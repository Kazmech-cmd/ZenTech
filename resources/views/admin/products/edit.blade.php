<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-zen-dark uppercase mt-2">Редактировать: {{ $product->name }}</h1>
        </div>

        <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-zen-light">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') {{-- Обязательно для обновления --}}
                
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Название</label>
                    <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Категория</label>
                        <select name="category_id" class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none appearance-none focus:ring-2 focus:ring-zen-green">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Цена (₽)</label>
                        <input type="number" name="price" value="{{ $product->price }}" required class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Описание</label>
                    <textarea name="description" rows="4" class="w-full bg-gray-50 border border-zen-light rounded-xl px-4 py-3 outline-none">{{ $product->description }}</textarea>
                </div>

                <button type="submit" class="w-full bg-zen-dark text-white font-bold py-5 rounded-2xl hover:bg-zen-green hover:text-zen-dark transition shadow-lg uppercase text-xs">
                    Сохранить изменения
                </button>
            </form>
        </div>
    </div>
</x-app-layout>