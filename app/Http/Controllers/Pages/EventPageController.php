<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventPageController extends Controller
{
    public function index()
    {
        return view('pages.event.index');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'start' => 'required|date',
                'event_type' => 'required|string',
            ],
            trans('eventValidation.messages'),
            trans('eventValidation.attributes'),
        );

        $request['user_id'] = Auth::id();
        $event = Event::create($request->input());

        return redirect()->route('view.event.index')
            ->with('success', 'Thêm lịch thành công!');
    }
}
