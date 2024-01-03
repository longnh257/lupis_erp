<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = User::query();
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
            $query->where("email", "LIKE", "%" . $s . "%");
        }
        if ($request->role) {
            $query->where('role', $request->role);
        }
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách người dùng thành công!', $datas);
    }
}
