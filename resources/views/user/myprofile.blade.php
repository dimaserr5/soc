<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мой профиль
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="block_info_profile">
                        <div class="block_info_profile_elem">
                            <span>Почта</span>
                            <span style="color: #c2c2c2;">{{ $usermail }}</span>
                        </div>
                        <div class="block_info_profile_elem">
                            <span>Имя</span>
                            <span style="color: #c2c2c2;">{{ $name }}</span>
                        </div>
                        <div class="block_info_profile_elem">
                            <span>Статус</span>
                            <span style="color: #c2c2c2;">{{ $user_status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
