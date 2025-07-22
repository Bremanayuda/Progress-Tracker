@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 480px;">
        <div class="card-header">Detail Peminjaman</div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Nama Peminjam</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->user->name }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Divisi</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->user->role }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Barang</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->barang->nama_barang }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Jumlah Pinjam</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->jumlah_pinjam }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Tanggal Pinjam</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->tanggal_pinjam }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Alasan Peminjaman</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->alasan }}</div>
            </div>
            <div class="form-group mb-3">
                <label>Status</label>
                <div class="form-control" style="background:#f8f9fa;">
                    @if($peminjaman->status == 'pending')
                        <span style="color: #e67e22; font-weight: 600;">Pending</span>
                    @elseif($peminjaman->status == 'approved')
                        <span style="color: #0a7c1c; font-weight: 600;">Approved</span>
                    @elseif($peminjaman->status == 'rejected')
                        <span style="color: #ed1c24; font-weight: 600;">Rejected</span>
                    @elseif($peminjaman->status == 'returned')
                        <span style="color: #0a7c1c; font-weight: 600;">Returned</span>
                    @endif
                </div>
            </div>
            <div class="form-group mb-3">
                <label>Tanggal pengembalian</label>
                @if($peminjaman->deadline)
                    <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->deadline }}</div>
                @else
                    <div class="form-control" style="background:#f8f9fa;">-</div>
                @endif
            </div>
            
            @if($peminjaman->status == 'pending')
                <div class="form-group mb-3">
                    <form method="POST" action="{{ route('koor.peminjaman.approve', $peminjaman->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="save-profile-btn" style="background: #0a7c1c; margin-right: 10px;">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('koor.peminjaman.reject', $peminjaman->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="save-profile-btn" style="background: #ed1c24;">Reject</button>
                    </form>
                </div>
            @endif
            
            @if($peminjaman->status == 'approved')
                <div class="form-group mb-3">
                    <a href="{{ route('koor.peminjaman.downloadPDF', $peminjaman->id) }}" class="save-profile-btn" style="background: #007bff; text-decoration: none; display: inline-block;" target="_blank">Download PDF Peminjaman</a>
                </div>
            @endif
            
            @if($peminjaman->status == 'returned')
                <div class="form-group mb-3">
                    <form method="POST" action="{{ route('koor.peminjaman.destroy', $peminjaman->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="save-profile-btn" style="background: #ed1c24;" onclick="return confirm('Yakin ingin menghapus riwayat peminjaman ini?')">Hapus Riwayat</button>
                    </form>
                </div>
            @endif
            
            @if($peminjaman->status == 'rejected')
                <div class="form-group mb-3">
                    <form method="POST" action="{{ route('koor.peminjaman.destroy', $peminjaman->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="save-profile-btn" style="background: #ed1c24;" onclick="return confirm('Yakin ingin menghapus peminjaman yang ditolak ini?')">Hapus Peminjaman</button>
                    </form>
                </div>
            @endif
            
            <center>
            <a href="{{ route('koor.peminjaman.index') }}" class="btn-kembali-1" style="margin-top:20px;">Kembali</a>
            </center>
        </div>
    </div>
</div>
@endsection 