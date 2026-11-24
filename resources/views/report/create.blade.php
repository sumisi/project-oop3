@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание заявок') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <a href="/reports" class="text-[40px] text-red-500">Посмотреть заявки</a>
                <form action="{{route('reports.store')}}" method = "POST">
                    @csrf
                    <input type="text" placeholder="Введите номер авто" required name="number"><br>
                    <textarea type="text" placeholder="Описание" required name="des"></textarea><br>
                    <input type="submit" value="Создать">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>