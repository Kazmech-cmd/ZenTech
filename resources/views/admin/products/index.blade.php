<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-black text-zen-dark uppercase">Управление товарами</h1>
            {{-- ИСПРАВЛЕНО: Добавили реальную ссылку на создание --}}
            <a href="{{ route('admin.products.create') }}"
                class="bg-zen-green text-zen-dark px-6 py-3 rounded-2xl font-bold hover:shadow-lg transition">
                + Добавить товар
            </a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-zen-light overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-zen-light">
                    <tr>
                        <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400">Товар</th>
                        <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400">Категория</th>
                        <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400">Цена</th>
                        <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zen-light">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-8 py-4 font-bold text-zen-dark">{{ $product->name }}</td>
                            <td class="px-8 py-4 text-gray-500">{{ $product->category->name }}</td>
                            <td class="px-8 py-4 font-black">{{ number_format($product->price, 0, '', ' ') }} ₽</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    {{-- ИСПРАВЛЕНО: Ссылка на редактирование (сделаем её позже) --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg">Редактировать</a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        {{-- ИСПРАВЛЕНО: Добавили текст/иконку внутрь кнопки, чтобы её было видно --}}
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"
                                            onclick="return confirm('Удалить этот товар?')">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>