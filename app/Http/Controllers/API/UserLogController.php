<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;

class UserLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = UserLog::query();
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
        }

        $query->orderBy('created_at', 'desc');
        $query->with(['user','created_by']);
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách vật liệu thành công!', $datas);
    }
}
