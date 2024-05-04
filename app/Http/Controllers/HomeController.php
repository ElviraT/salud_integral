<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanySettings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting = CompanySettings::first();
        return view('welcome', compact('setting'));
    }
}