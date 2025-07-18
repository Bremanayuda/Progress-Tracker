<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'koor':
                // Notifikasi: jumlah peminjaman pending dan telat
                $pendingCount = \App\Models\Peminjaman::where('status', 'pending')->count();
                $lateCount = \App\Models\Peminjaman::where('deadline', '<', now()->toDateString())
                    ->where('status', '!=', 'returned')
                    ->count();
                return view('koor.dashboard', compact('pendingCount', 'lateCount'));
            case 'ICT':
                return view('ict.dashboard');
            default:
                // Ambil peminjaman milik user general yang belum dikembalikan
                $peminjaman = Peminjaman::where('user_id', $user->id)
                    ->where('status', '!=', 'returned')
                    ->latest()
                    ->first();
                return view('general.dashboard', compact('peminjaman'));
        }
    }
} 