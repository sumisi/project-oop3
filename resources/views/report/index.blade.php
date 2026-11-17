@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список заявок') }}
        </h2>
    </x-slot>
    <h1 class="text-[40px]">Заявки</h1>
    <a href="/reports/create" class="text-[40px] text-red-500">Создать заявку</a>
    <div class="container mx-auto">
        <x-filter :sort=$sort :status=$status></x-filter>
        {{$reports->appends(request()->query())->links(  )}}
        <div class="grid grid-cols-4 gap-2 place-items-center">
            @foreach($reports as $report)
                <div class="bg-amber-300 h-[300px] p-[10px] w-[300px]">
                    {{$report->number}}<br>
                    {{$report->des}}<br>
                    {{$report->created_at}}<br>
                    <x-status :type="$report->status->id">
                        {{$report->status->name}}
                    </x-status>
                    <a href="{{route('reports.edit', $report->id)}}">
                        Изменить заявку
                    </a><br>
                    <form action="{{route('reports.destroy', $report->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Удалить заявку" class="text-red-500 text-[20px] font-bold">
                    </form>
                </div>
            @endforeach 
        </div>
    </div>
</x-app-layout>