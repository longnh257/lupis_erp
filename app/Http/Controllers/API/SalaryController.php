<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryConfig;
use App\Models\SalaryDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = SalaryDetail::query();
        if ($request->created_at) {
            $date = new Carbon($request->created_at);
            $query->whereDate('created_at', $date);
        }
        /*    if ($request->status) {
            $query->where('status', $request->status);
        } */
        /* 
        if ($request->user_name) {
            $user_name = $request->user_name;
            $query->whereHas('assigned_user', function (Builder $query) use ($user_name) {
                $query->where('name', 'like', '%' . $user_name . '%');
            });
        } */

        /*  $query->with(["user", "salary_items",  "assigned_user"]); */
        if (in_array(Auth::user()->role->name, ['full_time_driver', 'part_time_driver'])) {
            $query->where('assigned_to', Auth::id());
        }
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách đơn hàng thành công!', $datas);
    }
}
