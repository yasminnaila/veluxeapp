<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard.index'); // Pastikan file view ada di resources/views/dashboard/index.blade.php
    }
}

