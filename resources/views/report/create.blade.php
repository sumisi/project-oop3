@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание заявок') }}
        </h2>
    </x-slot>
    <a href="/reports" class="text-[40px] text-red-500">Посмотреть заявки</a>
    <form action="{{route('reports.store')}}" method = "POST">
        @csrf
        <input type="text" placeholder="Введите номер авто" required name="number"><br>
        <textarea type="text" placeholder="Описание" required name="des"></textarea><br>
        <input type="submit" value="Создать">
    </form>
</x-app-layout>