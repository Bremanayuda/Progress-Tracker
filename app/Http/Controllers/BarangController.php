<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('koor.barang_index', compact('barangs'));
    }

    public function create()
    {
        return view('koor.barang_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
        ]);
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('koor.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        
        $peminjamanAktif = $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->exists();
        
        if ($peminjamanAktif) {
            $jumlahPeminjaman = $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->count();
            return redirect()->route('koor.barang.index')->with('error', "Barang tidak dapat dihapus karena sedang dipinjam oleh {$jumlahPeminjaman} peminjam!");
        }
        
        $barang->delete();
        return redirect()->route('koor.barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
