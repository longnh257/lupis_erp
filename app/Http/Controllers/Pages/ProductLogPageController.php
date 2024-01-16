<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Http\Request;

class ProductLogPageController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.product-log.index');
    }

}
