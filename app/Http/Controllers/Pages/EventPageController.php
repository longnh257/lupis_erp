<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class EventPageController extends Controller
{
    public function index()
    {
        return view('pages.event.index');
    }

}
