<?php

namespace App\Http\Controllers\Backend_old;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function login()
    {
        return view('backend.login');
    }
}
