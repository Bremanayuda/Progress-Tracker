@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="container-barang-utama">
    <div class="retangle-putih">
        <div class="judul-barang">Daftar Peminjaman Barang</div>
        <div class="rect-barang">
            <div style="overflow-x:auto;">
                <table class="table table-striped" style="width:100%; min-width:600px;">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Role</th>
                            <th>Barang</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->user->role }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->deadline ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 