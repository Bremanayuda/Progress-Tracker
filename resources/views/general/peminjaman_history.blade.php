@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 800px;">
        <div class="card-header">Riwayat Peminjaman Barang</div>
        <div class="card-body">
            @if($peminjamans->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $index => $peminjaman)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                                    <td>{{ $peminjaman->jumlah_pinjam }}</td>
                                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                    <td>{{ $peminjaman->deadline ?? '-' }}</td>
                                    <td>
                                        @if($peminjaman->status == 'pending')
                                            <span style="color: #e67e22; font-weight: 600;">Pending</span>
                                        @elseif($peminjaman->status == 'approved')
                                            <span style="color: #0a7c1c; font-weight: 600;">Approved</span>
                                        @elseif($peminjaman->status == 'rejected')
                                            <span style="color: #ed1c24; font-weight: 600;">Rejected</span>
                                        @elseif($peminjaman->status == 'returned')
                                            <span style="color: #0a7c1c; font-weight: 600;">Returned</span>
                                        @endif
                                    </td>
                                    <td>{{ $peminjaman->alasan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 40px;">
                    <p style="color: #666; font-size: 16px;">Belum ada riwayat peminjaman</p>
                </div>
            @endif
            
            <center>
                <a href="{{ route('dashboard') }}" class="btn-kembali-1" style="margin-top:20px;">Kembali ke Dashboard</a>
            </center>
        </div>
    </div>
</div>
@endsection 