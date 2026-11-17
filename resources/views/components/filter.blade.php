@props(['sort', 'status'])
<div>
    <h2>Фильтрация по новизне:</h2>
    <span>
        <a href="{{route('reports.index', ['sort' => 'desc', 'status' => $status])}}">Сначала новые</a>
        <a href="{{route('reports.index', ['sort' => 'asc', 'status' => $status])}}">Сначала старные</a>
    </span>
</div>
<div>
    <h2>Фильтрация по по статусу:</h2>
        <ul>
            @foreach ($statuses as $status)
                <li>
                    <a href="{{route('reports.index', ['sort' => $sort,'status' => $status->id])}}">{{$status->name}}</a>
                </li>
            @endforeach
        </ul>
</div> 