<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report; 
use App\Models\Status;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Format;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        if($sort != 'asc' && $sort != 'desc')
        {
            $sort = 'desc';
        }

        $status = $request->input('status');
        $validate = $request->validate([
            'status' => 'exists:statuses,id'
        ]);
        if($validate)
        {
            $reports = Report::where('status_id', $status)->where('user_id', Auth::user()->id)->orderBy('created_at',$sort)->paginate(4);
        }
        else{
            $reports = Report::where('user_id', Auth::user()->id)->orderBy('created_at', $sort)->paginate(4);
        }
        $statuses = Status::all();

        return view('report.index', compact('reports', 'statuses', 'sort', 'status'));
    }

    public function store(Request $request, Report $report)
    {
        $data = $request->validate([
            'number' => 'required|string',
            'des' => 'required|string',
            'path_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('path_img');

        
        $img = Image::decode($file);
        $img->scaleDown(width: 400);

        $encoded = $img->encodeUsingFormat(Format::WEBP, quality: 80);

        $imagPath = 'reports/' . time() . '.webp';
        Storage::disk('public')->put($imagPath, $encoded->toString());

        $data['path_img'] = $imagPath;
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;

        $report->create($data);


        return redirect()->route('reports.index')->with('info', "Заявление отправлено");

    }

    public function edit(Report $report)
    {
        if(Auth::user()->id === $report->user_id)
            {
                return view('report.edit', compact('report'));
            }
        else{
            abort(403, "У вас нет доступа для редактирования этой заявки");
        }
    }

    public function update(Request $request, Report $report)
    {
        $data = $request -> validate([
            'number' => 'required|string',
            'des' => 'required|string'
        ]);
        $report->update($data);
        return redirect()->route('reports.index')->with('info', "Заявка изменена");
    }

    public function destroy(Report $report)
    {
        if(Auth::user()->id === $report->user_id)
            { 
                $report->delete();
                return redirect()->back()->with('info', "Заявление удалено");
            }
        else{
            abort(403, "У вас нет доступа для удаления этой заявки");
        }
    }

    public function statusUpdate(Request $request, Report $report)
    {
        $request -> validate([
            'status_id' => 'required|exists:statuses,id'
        ]);
        $report->update($request->only(['status_id']));
        return redirect()->back()->with('info', "Статус изменен");
    }
}
