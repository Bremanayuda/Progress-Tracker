@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 900px;">
        <div class="card-header">Daftar Peminjaman Barang</div>
        <div class="card-body">

            <div style="overflow-x:auto;">
                <table class="table table-striped" style="width:100%; min-width:700px;">
                    <thead>
                        <tr> 
                            <th>Nama Peminjam</th>
                            <th>Divisi</th>
                            <th>Barang</th>
                            <th>Jumlah Pinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->user->role }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->jumlah_pinjam }}</td>
                            <td>{{ $p->tanggal_pinjam }}</td>
                            <td>{{ $p->deadline ?? '-' }}</td>
                            <td>
                                @if($p->status == 'pending')
                                    <span style="color: #e67e22; font-weight: 600;">Pending</span>
                                @elseif($p->status == 'approved')
                                    <span style="color: #0a7c1c; font-weight: 600;">Approved</span>
                                @elseif($p->status == 'rejected')
                                    <span style="color: #ed1c24; font-weight: 600;">Rejected</span>
                                @elseif($p->status == 'returned')
                                    <span style="color: #0a7c1c; font-weight: 600;">Returned</span>
                                @endif
                            </td>
                            <td style="display: flex; gap: 6px;">
                                <a href="{{ route('koor.peminjaman.show', $p->id) }}" class="save-profile-btn" style="padding:6px 14px; font-size:14px;">Detail</a>
                                @if($p->status === 'returned')
                                <form method="POST" action="{{ route('koor.peminjaman.destroy', $p->id) }}" onsubmit="return confirm('Hapus riwayat peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus-barang" style="padding:6px 14px; font-size:14px;">Hapus</button>
                                </form>
                                @endif
                                @if($p->status === 'rejected')
                                <form method="POST" action="{{ route('koor.peminjaman.destroy', $p->id) }}" onsubmit="return confirm('Hapus peminjaman yang ditolak ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus-barang" style="padding:6px 14px; font-size:14px;">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 24px;">
            <a href="{{ route('koor.peminjaman.page') }}" class="btn-kembali-2">Kembali</a>
        </div>
    </div>
</div>

@endsection 