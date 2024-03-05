<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventPageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('pages.event.index',compact('users'));
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate(
            [
                'start' => 'required|date',
                'event_type' => 'required|string',
                'user_id' => 'required',
            ],
            trans('eventValidation.messages'),
            trans('eventValidation.attributes'),
        );
        if ($request->event_type == 'work') {
            $request['status'] = 1;
        }
        //cho phép admin chọn user để tạo lịch
        if ($user->checkUserRole()) {
        } else {
            $request['user_id'] = Auth::id();
        }
        $event = Event::create($request->input());

        return redirect()->route('view.event.index')
            ->with('success', 'Thêm lịch thành công!');
    }

    public function updateStatus(Event $model, Request $request)
    {

        $model->update([
            'status' => $request->status,
            'reason' => $request->reason,
        ]);

        return redirect()->route('view.event.index')
            ->with('success', 'Thêm lịch thành công!');
    }

    public function edit(Event $model)
    {
        dd($model->user);
    }

    public function user_event()
    {
        return view('pages.event.user-event');
    }

    public function store_user_event(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate(
            [
                'start' => 'required|date',
                'event_type' => 'required|string',
            ],
            trans('eventValidation.messages'),
            trans('eventValidation.attributes'),
        );
        if ($request->event_type == 'work') {
            $request['status'] = 1;
        }
        //cho phép admin chọn user để tạo lịch
        if ($user->checkUserRole()) {
        } else {
            $request['user_id'] = Auth::id();
        }
        $event = Event::create($request->input());

        return redirect()->route('view.user_event.index')
            ->with('success', 'Thêm lịch thành công!');
    }
}
