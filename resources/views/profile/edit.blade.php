<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="px-4 sm:px-0">
                <h2 class="text-3xl font-black text-zen-dark uppercase tracking-tighter">
                    Настройки <span class="text-zen-green">профиля</span>
                </h2>
                <p class="mt-1 text-sm text-gray-400 font-medium">Управляйте своими данными и безопасностью аккаунта</p>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-zen-light rounded-[3rem]">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-zen-dark uppercase tracking-widest mb-6">Личные данные</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-zen-light rounded-[3rem]">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-zen-dark uppercase tracking-widest mb-6">Безопасность</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-red-50 rounded-[3rem]">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-red-500 uppercase tracking-widest mb-6">Удаление аккаунта</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>