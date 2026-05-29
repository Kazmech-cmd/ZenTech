<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Вход | ZENTECH</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f8fafc]">
    
    </body>
</html>

<div class="min-h-screen flex flex-col items-center justify-center bg-[#f8fafc] px-4 font-sans">
    <div class="mb-10 transform hover:scale-105 transition-transform duration-300">
        <a href="/" class="text-4xl font-black text-zen-dark tracking-tighter">
            ZEN<span class="text-zen-green">TECH</span>
        </a>
    </div>

    <div class="w-full max-w-[440px] bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-zen-light p-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-zen-dark uppercase tracking-tight">Вход</h2>
            <p class="text-gray-400 text-sm mt-2">Добро пожаловать в мир технологий</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-4">Электронная почта</label>
                <input type="email" name="email" :value="old('email')" required autofocus 
                    class="w-full bg-gray-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:bg-white focus:border-zen-base focus:ring-0 transition-all duration-300 text-zen-dark font-medium">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-4">Пароль</label>
                <input type="password" name="password" required
                    class="w-full bg-gray-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:bg-white focus:border-zen-base focus:ring-0 transition-all duration-300 text-zen-dark font-medium">
            </div>

            <div class="flex items-center justify-between px-2">
                <label class="flex items-center group cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-zen-green focus:ring-zen-base transition-all">
                    <span class="ml-2 text-xs font-bold text-gray-400 group-hover:text-zen-dark transition-colors uppercase tracking-widest">Запомнить</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-gray-400 hover:text-zen-green transition-colors uppercase tracking-widest" href="{{ route('password.request') }}">
                        Забыли?
                    </a>
                @endif
            </div>

            <button type="submit" 
                class="w-full bg-zen-dark text-white font-black py-5 rounded-[1.5rem] hover:bg-zen-green hover:text-zen-dark transition-all duration-300 shadow-xl shadow-zen-base/10 uppercase tracking-[0.2em] text-xs mt-4 active:scale-95">
                Войти в аккаунт
            </button>
        </form>

        <div class="mt-10 pt-8 border-t border-gray-50 text-center">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-4">Впервые у нас?</p>
            <a href="{{ route('register') }}" 
                class="inline-block w-full py-4 border-2 border-zen-dark text-zen-dark rounded-[1.5rem] font-black uppercase tracking-[0.1em] text-xs hover:bg-zen-dark hover:text-white transition-all duration-300">
                Создать аккаунт ZenTech
            </a>
        </div>
    </div>

    <a href="/" class="mt-8 text-gray-400 hover:text-zen-dark transition-colors flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        На главную
    </a>
</div>