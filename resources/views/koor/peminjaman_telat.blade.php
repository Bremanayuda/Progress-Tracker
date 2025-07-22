@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 900px;">
        <div class="card-header" style="color:#c4141a;">Notifikasi Peminjaman Telat</div>
        <div class="card-body">
            @if($telat->isEmpty())
                <div style="text-align:center; color:#888; font-size:17px;">Tidak ada pinjaman yang telat.</div>
            @else
            <div style="overflow-x:auto;">
                <table class="table table-striped" style="width:100%; min-width:700px;">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Role</th>
                            <th>Barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($telat as $p)
                        <tr style="background:#fff0f0;">
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->user->role }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->tanggal_pinjam }}</td>
                            <td>{{ $p->deadline }}</td>
                            <td style="color:#c4141a; font-weight:bold;">{{ ucfirst($p->status) }}</td>
                            <td>{{ $p->alasan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <a href="{{ route('koor.peminjaman.index') }}" class="save-profile-btn" style="background:#888; margin-top:18px;">Kembali</a>
        </div>
    </div>
</div>
@endsection 