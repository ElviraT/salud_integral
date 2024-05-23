<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use App\Models\Permission;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::get()->count();
        $tickets = Ticket::where('state_id', '3')->get()->count();

        return view('dashboard', compact('user', 'tickets'));
    }
}
