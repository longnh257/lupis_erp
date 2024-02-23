<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    //lấy list toàn bộ event
    public function index(Request $request)
    {
        $query  = Event::query();
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
        }
        $query->with(["user", "products",  "assigned_to"]);
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách đơn hàng thành công!', $datas);
    }
    //lấy list event của cho user
    public function userEvent(Request $request)
    {
        $user = Auth::user();
        $query  = Event::query();
        if (!User::checkUserRole()) {
            $query =  $query->where('user_id', $user->id);
        }
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
        }
        $workEvents = clone  $query;
        $offEvents = clone  $query;
        $workEvents = $workEvents->where('event_type', 'work')->get();
        $offEvents = $offEvents->where('event_type', 'off')->get();
        $allEvents = $query->paginate($this->numPerPage);

        return [
            'message' => "Get list success",
            "workEvents" =>  [
                'id' => 1,
                'borderColor' => '#0162e8',
                'backgroundColor' => '#0162e8',
                'textColor' => '#fff',
                'events' => $workEvents
            ],
            "offEvents" =>  [
                'id' => 2,
                'borderColor' => '#ffc107',
                'backgroundColor' => '#ffc107',
                'textColor' => '#fff',
                'events' => $offEvents
            ],
            "result" =>  $allEvents,
        ];
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'event_date' => 'required|date',
                'event_type' => 'required|string',
                'shift' => 'required|string',
            ],
            trans('eventValidation.messages'),
            trans('eventValidation.attributes'),
        );

        $request['user_id'] = Auth::id();
        $event = Event::create($request->input());

        return $this->hasSuccess('Tạo sự kiện thành công!', $event);
    }

    public function approveEvent(Event $event)
    {
        $event->update(['approved' => 1]);

        return $this->hasSuccess('Thành công!', $event);
    }

    public function pendingEvent(Event $event)
    {
        $event->update(['approved' => 0]);
        return $this->hasSuccess('Thành công!', $event);
    }
    public function delete(Event $model)
    {
        if ($model->approved) {
            return $this->hasError('Lịch đã được duyệt, vui lòng liên hệ quản lý nếu cần sửa đổi!', $model);
        }
        $model->delete();
        return $this->hasSuccess('Thành công!', []);
    }
}
