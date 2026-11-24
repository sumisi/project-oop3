@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Создание заявок') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-5">
                <a href="/reports" class="block text-2xl sm:text-[40px] leading-tight text-red-500 mb-4 break-words">
                    Посмотреть заявки
                </a>
                <form action="{{ route('reports.store') }}" method="POST" class="flex flex-col items-start gap-3">
                    @csrf
                    <input type="text" placeholder="Введите номер авто" required name="number" class="w-full sm:w-auto max-w-full box-border">
                    <textarea placeholder="Описание" required name="des" class="w-full sm:w-auto max-w-full box-border"></textarea>
                    <input type="submit" value="Создать" class="w-full sm:w-auto cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
