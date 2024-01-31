<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = Order::query();
        if ($request->created_at) {
            $date = new Carbon($request->created_at);
            $query->whereDate('created_at', $date);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->user_name) {
            $user_name = $request->user_name;
            $query->whereHas('assigned_user', function (Builder $query) use ($user_name) {
                $query->where('name', 'like', '%' . $user_name . '%');
            });
        }

        $query->with(["user", "order_items",  "assigned_user"]);
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách đơn hàng thành công!', $datas);
    }
}
