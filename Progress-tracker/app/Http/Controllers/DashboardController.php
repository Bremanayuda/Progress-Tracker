<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Task;

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
                $tasks = Task::where('pic', $user->name)->orderByDesc('created_at')->get();
                return view('ict.dashboard', compact('tasks'));
            default:
                // Ambil peminjaman milik user general yang belum dikembalikan
                $peminjaman = Peminjaman::where('user_id', $user->id)
                    ->where('status', '!=', 'returned')
                    ->latest()
                    ->first();
                return view('general.dashboard', compact('peminjaman'));
        }
    }

    public function progressICT()
    {
        if (Auth::user()->role !== 'ICT') {
            abort(403);
        }
        $tasks = Task::where('pic', Auth::user()->name)->orderByDesc('created_at')->get();
        return view('ict.progress', compact('tasks'));
    }
} 