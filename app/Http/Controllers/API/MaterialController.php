<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $numPerPage = 10;
    public function index(Request $request)
    {
        $query  = Material::query();
        if ($s = $request->has("s")) {
            $query->where("name", "LIKE", "%" . $s . "%");
        }
      
        $datas = $query->paginate($this->numPerPage);

        return $this->hasSuccess('Lấy danh sách vật liệu thành công!', $datas);
    }
}
