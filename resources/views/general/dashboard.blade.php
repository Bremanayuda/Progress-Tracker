@extends('layouts.dashboard')

@section('title', 'Dashboard ' . Auth::user()->role)

@section('content')
<div class="wrapper min-h-screen flex flex-col justify-center items-center" style="position: relative; z-index: 1;">
    <header class="header-2 text-center mt-8">
        @if($peminjaman)
        <div class="flex justify-center w-full">
            <div style="max-width:420px; margin:32px auto 0 auto;">
                <div style="background:#fff; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); padding:24px 20px; display:flex; align-items:center; justify-content:space-between;">
                    <div style="text-align:left;">
                        <div style="font-size:16px; font-weight:600; color:#ed1c24;">Status Peminjaman Barang</div>
                        <div style="margin-top:8px; font-size:15px; color:#222;">
                            Barang: <b>{{ $peminjaman->barang->nama_barang ?? '-' }}</b><br>
                            Tanggal Pinjam: <b>{{ $peminjaman->tanggal_pinjam }}</b>
                        </div>
                        @if($peminjaman->status == 'approved')
                            <div style="margin-top:8px; color:#0a7c1c; font-weight:500;">Disetujui, Deadline: {{ $peminjaman->deadline }}</div>
                        @elseif($peminjaman->status == 'rejected')
                            <div style="margin-top:8px; color:#ed1c24; font-weight:500;">Ditolak oleh koordinator</div>
                        @else
                            <div style="margin-top:8px; color:#e67e22; font-weight:500;">Status: Pending (Menunggu approval dari koor)</div>
                        @endif
                    </div>
                    <div style="margin-left:18px;">
                        @if($peminjaman->status == 'approved')
                            <span style="display:inline-block; background:#0a7c1c; color:#fff; padding:8px 18px; border-radius:8px; font-weight:600;">Disetujui</span>
                            <form method="POST" action="{{ route('general.peminjaman.return', $peminjaman->id) }}" style="margin-top:12px;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background:#ed1c24; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-weight:600; cursor:pointer;">Kembalikan</button>
                            </form>
                        @elseif($peminjaman->status == 'rejected')
                            <span style="display:inline-block; background:#ed1c24; color:#fff; padding:8px 18px; border-radius:8px; font-weight:600;">Ditolak</span>
                        @else
                            <span style="display:inline-block; background:#e67e22; color:#fff; padding:8px 18px; border-radius:8px; font-weight:600;">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="flex flex-col items-center gap-2 w-full">
            <div class="flex flex-row items-center gap-4 justify-center mt-6">
                <a href="{{ route('general.peminjaman.create') }}" class="save-profile-btn" style="max-width:260px; margin-bottom: 0;">Ajukan</a>
                <a href="{{ route('general.peminjaman.history') }}" class="save-profile-btn" style="max-width:260px; background: #007bff; margin-bottom: 0;">Lihat Riwayat Peminjaman</a>
            </div>
        </div>
    </header>
</div>
<footer class="footer">
  <img src="/image/logo.png" alt="Logo" class="footer-logo">
  <p class="footer-text">ICT SUPPORT</p>
</footer>
@endsection 