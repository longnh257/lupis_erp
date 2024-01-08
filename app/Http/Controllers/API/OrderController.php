<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = Order::query();
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
        }
        $query->with(["user", "products",  "assigned_to"]);
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách đơn hàng thành công!', $datas);
    }
}
