<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::get()->count();
        $dark_mode = 0;
        return view('dashboard', compact('user', 'dark_mode'));
    }
}