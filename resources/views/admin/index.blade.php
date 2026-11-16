@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-app-layout>
        <div class="mb-4">
            <h1 class="font-bold text-red-500">Административная панель</h1>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="text-sm font-normal text-gray-800">
                        <th class="pb-3 pr-6 font-normal w-1/4">ФИО</th>
                        <th class="pb-3 pr-6 font-normal w-2/5">Текст заявления</th>
                        <th class="pb-3 pr-6 font-normal w-1/5">Номер автомобиля</th>
                        <th class="pb-3 pr-6 font-normal">Статус</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @foreach($reports as $report)
                    <tr>
                        <td class="py-2.5 pr-6 align-top whitespace-nowrap">
                            {{ $report->user->name}}
                        </td>
                        <td class="py-2.5 pr-6 align-top leading-relaxed">
                            {{ $report->des }}
                        </td>
                        <td class="py-2.5 pr-6 align-top whitespace-nowrap">
                            {{ $report->number }}
                        </td>
                        <td class="py-2.5 pr-6 align-top whitespace-nowrap">
                            @if($report->status_id == 1)
                            <form class="status-form" action="{{route('reports.status.update', $report->id)}}" method="POST">
                                @method('patch')
                                @csrf
                                <select name="status_id" id="status_id" onchange="this.form.submit()">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $status->id == $report->status_id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            @else
                            {{$report->status->name}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>
