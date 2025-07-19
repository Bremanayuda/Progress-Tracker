<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Form peminjaman barang (General)
    public function create()
    {
        $barangs = Barang::all();
        return view('general.peminjaman_create', compact('barangs'));
    }

    // Simpan data peminjaman (General)
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'alasan' => 'required|string',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);
        $barang = Barang::findOrFail($request->barang_id);
        if ($request->jumlah_pinjam > $barang->jumlah) {
            return back()->withErrors(['jumlah_pinjam' => 'Jumlah pinjam melebihi stok barang!'])->withInput();
        }
        // Tidak mengurangi stok barang di sini
        Peminjaman::create([
            'barang_id' => $request->barang_id,
            'user_id' => Auth::id(),
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'deadline' => $request->tanggal_kembali,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);
        return redirect()->route('dashboard')->with('success', 'Pengajuan peminjaman berhasil!');
    }

    // Daftar peminjam (Koor) - tampilkan semua status
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        return view('koor.peminjaman_index', compact('peminjamans'));
    }

    // Detail pinjaman (Koor)
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->findOrFail($id);
        return view('koor.peminjaman_show', compact('peminjaman'));
    }

    // Approve peminjaman (Koor)
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = $peminjaman->barang;
        
        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Status peminjaman tidak valid untuk approval.');
        }
        
        if ($peminjaman->jumlah_pinjam > $barang->jumlah) {
            return back()->with('error', 'Stok barang tidak mencukupi untuk approval.');
        }
        
        // Kurangi stok barang saat approval
        $barang->jumlah -= $peminjaman->jumlah_pinjam;
        $barang->save();
        
        $peminjaman->status = 'approved';
        $peminjaman->save();
        
        return redirect()->route('koor.peminjaman.index')->with('success', 'Peminjaman berhasil disetujui!');
    }

    // Reject peminjaman (Koor)
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Status peminjaman tidak valid untuk rejection.');
        }
        
        $peminjaman->status = 'rejected';
        $peminjaman->save();
        
        return redirect()->route('koor.peminjaman.index')->with('success', 'Peminjaman berhasil ditolak!');
    }

    // Set deadline pinjaman (Koor) - untuk backward compatibility
    public function setDeadline(Request $request, $id)
    {
        $request->validate([
            'deadline' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = $peminjaman->barang;
        // Kurangi stok barang saat approval jika belum pernah di-approve
        if ($peminjaman->status === 'pending' && $peminjaman->jumlah_pinjam <= $barang->jumlah) {
            $barang->jumlah -= $peminjaman->jumlah_pinjam;
            $barang->save();
        }
        $peminjaman->deadline = $request->deadline;
        $peminjaman->status = 'approved';
        $peminjaman->save();
        return redirect()->route('koor.peminjaman.show', $id)->with('success', 'Deadline berhasil ditetapkan!');
    }

    // Notifikasi pinjaman telat (Koor)
    public function notifikasiTelat()
    {
        $today = now()->toDateString();
        $telat = Peminjaman::where('deadline', '<', $today)
            ->where('status', '!=', 'returned')
            ->with(['user', 'barang'])
            ->get();
        return view('koor.peminjaman_telat', compact('telat'));
    }

    // Daftar peminjam (ICT)
    public function listICT()
    {
        $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        return view('ict.peminjaman_list', compact('peminjamans'));
    }

    // Riwayat peminjaman (General)
    public function history()
    {
        $peminjamans = Peminjaman::where('user_id', Auth::id())
            ->with(['barang'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('general.peminjaman_history', compact('peminjamans'));
    }

    // Pengembalian barang (General)
    public function return(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->status === 'returned') {
            return back()->with('info', 'Barang sudah dikembalikan sebelumnya.');
        }
        $barang = $peminjaman->barang;
        $barang->jumlah += $peminjaman->jumlah_pinjam;
        $barang->save();
        $peminjaman->status = 'returned';
        $peminjaman->save();
        return redirect()->route('dashboard')->with('success', 'Barang berhasil dikembalikan!');
    }

    // Download PDF peminjaman (Koor)
    public function downloadPDF($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->findOrFail($id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('koor.peminjaman_pdf', compact('peminjaman'));
        
        return $pdf->download('peminjaman-' . $peminjaman->id . '.pdf');
    }

    // Hapus peminjaman (hanya jika sudah dikembalikan atau ditolak)
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->status !== 'returned' && $peminjaman->status !== 'rejected') {
            return back()->with('error', 'Hanya peminjaman yang sudah dikembalikan atau ditolak yang dapat dihapus.');
        }
        $peminjaman->delete();
        return back()->with('success', 'Riwayat peminjaman berhasil dihapus.');
    }
}
