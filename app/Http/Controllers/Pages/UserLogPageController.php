<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogPageController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.user-log.index');
    }

}
