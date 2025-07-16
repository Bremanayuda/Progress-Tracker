<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'koor':
                return view('dashboard.koor');
            case 'ICT':
                return view('dashboard.ict');
            default:
                return view('dashboard.general');
        }
    }
} 