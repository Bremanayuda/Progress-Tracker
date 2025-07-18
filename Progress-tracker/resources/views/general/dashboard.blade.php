@extends('layouts.dashboard')

@section('title', 'Dashboard ' . Auth::user()->role)

@section('content')
<div class="wrapper">
    <header class="header-2">
        <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
        <p>Role: General</p>
    </header>
    <main class="main-content" style="margin-top:32px; text-align:center;">
        <div style="margin-bottom:24px;">
            <h3>Fitur Utama</h3>
            <ul style="list-style: none; padding:0;">
                <li>• Ajukan peminjaman barang ke koordinator</li>
                <li>• Lihat status peminjaman di menu Daftar Peminjaman (jika tersedia)</li>
            </ul>
        </div>
        <a href="{{ route('general.peminjaman.create') }}" class="save-profile-btn" style="max-width:260px;">Ajukan Peminjaman Barang</a>

        @if($peminjaman)
        <div style="max-width:420px; margin:32px auto 0 auto;">
            <div style="background:#fff; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); padding:24px 20px; display:flex; align-items:center; justify-content:space-between;">
                <div style="text-align:left;">
                    <div style="font-size:16px; font-weight:600; color:#ed1c24;">Status Peminjaman Barang</div>
                    <div style="margin-top:8px; font-size:15px; color:#222;">
                        Barang: <b>{{ $peminjaman->barang->nama_barang ?? '-' }}</b><br>
                        Tanggal Pinjam: <b>{{ $peminjaman->tanggal_pinjam }}</b>
                    </div>
                    @if($peminjaman->deadline)
                        <div style="margin-top:8px; color:#0a7c1c; font-weight:500;">Disetujui, Deadline: {{ $peminjaman->deadline }}</div>
                    @else
                        <div style="margin-top:8px; color:#e67e22; font-weight:500;">Status: Pending (Menunggu deadline dari koor)</div>
                    @endif
                </div>
                <div style="margin-left:18px;">
                    @if($peminjaman->deadline)
                        <span style="display:inline-block; background:#0a7c1c; color:#fff; padding:8px 18px; border-radius:8px; font-weight:600;">Disetujui</span>
                        <form method="POST" action="{{ route('general.peminjaman.return', $peminjaman->id) }}" style="margin-top:12px;">
                            @csrf
                            @method('PUT')
                            <button type="submit" style="background:#ed1c24; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-weight:600; cursor:pointer;">Kembalikan</button>
                        </form>
                    @else
                        <span style="display:inline-block; background:#e67e22; color:#fff; padding:8px 18px; border-radius:8px; font-weight:600;">Pending</span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </main>
</div>
<footer class="footer">
  <img src="/image/logo.png" alt="Logo" class="footer-logo">
  <p class="footer-text">ICT SUPPORT</p>
</footer>
@endsection 