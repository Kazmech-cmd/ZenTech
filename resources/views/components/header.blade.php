<header class="bg-white border-b border-zen-light sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-bold text-zen-dark tracking-tighter">
                    ZEN<span class="text-zen-green">TECH</span>
                </a>
            </div>

            <div class="ml-6 relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                    class="flex items-center bg-zen-dark text-white px-5 py-2.5 rounded-lg hover:bg-opacity-90 transition focus:outline-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    Каталог
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute left-0 mt-2 w-64 bg-white border border-zen-light rounded-2xl shadow-xl z-50 py-2"
                    style="display: none;">

                    @isset($categories)
                        @foreach($categories as $category)
                            <a href="{{ route('category.show', $category->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-zen-light hover:text-zen-dark transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @else
                        <p class="px-4 py-2 text-gray-400 text-sm">Категории не загружены</p>
                    @endisset
                </div>
            </div>

            <div class="flex-1 mx-8">
                <div class="relative">
                    <input type="text" placeholder="Поиск техники..."
                        class="w-full bg-gray-100 border-none rounded-xl py-2.5 pl-10 focus:ring-2 focus:ring-zen-base">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}"
                    class="text-gray-600 hover:text-zen-green transition-colors relative p-1">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>

                    @auth
                        @php $count = Auth::user()->cartItems->sum('quantity'); @endphp
                        @if($count > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-zen-green text-zen-dark text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                                {{ $count }}
                            </span>
                        @endif
                    @endauth
                </a>

                @auth
                    <a href="{{ route('profile.edit') }}"
                        class="text-zen-dark font-bold hover:text-zen-green transition-colors uppercase tracking-widest text-xs">
                        {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-zen-dark text-white px-8 py-3 rounded-xl font-bold hover:bg-zen-green hover:text-zen-dark transition-all shadow-md text-sm uppercase tracking-widest">
                        ВОЙТИ
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>