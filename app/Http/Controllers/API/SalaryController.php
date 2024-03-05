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
        if ($request->payday) {
            $date = new Carbon($request->payday);
            $query->whereDate('payday', $date);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->user_name) {
            $user_name = $request->user_name;
            $query->whereHas('user', function (Builder $query) use ($user_name) {
                $query->where('name', 'like', '%' . $user_name . '%');
            });
        }

        $query->with(["user"]);
        $user = User::find(Auth::id());
        if (!$user->checkUserRole()) {
            $query->where('user_id', Auth::id());
        }
        $datas = $query->orderBy('id', 'desc')->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách đơn hàng thành công!', $datas);
    }
}
