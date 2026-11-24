@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список заявок') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 sm:p-5">
                <h1 class="text-2xl sm:text-[40px]">Заявки</h1>
                @include('layouts.flash-messages')
                <a href="/reports/create" class="text-2xl sm:text-[40px] text-red-500 block sm:inline">Создать заявку</a>
                <div class="overflow-x-auto">
                    <x-filter :sort=$sort :status=$status></x-filter>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-10">
                    @foreach($reports as $report)
                        <div class="bg-amber-300 min-h-[300px] sm:h-[300px] p-[10px] w-full sm:w-[250px] break-words">
                            {{$report->number}}<br>
                            {{$report->des}}<br>
                            {{\Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y h:i');}}<br>
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
                <div class="overflow-x-auto">
                    {{$reports->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
