@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 480px;">
        <div class="card-header">Detail Peminjaman</div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Barang</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->barang->nama_barang }}</div>
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
                <label>Deadline</label>
                @if($peminjaman->deadline)
                    <div class="form-control" style="background:#f8f9fa;">{{ $peminjaman->deadline }}</div>
                @else
                    <form method="POST" action="{{ route('koor.peminjaman.setDeadline', $peminjaman->id) }}">
                        @csrf
                        <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" required>
                        @error('deadline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="save-profile-btn" style="margin-top:0px;">Approve</button>
                    </form> 
                @endif
            </div>
            <center>
            <a href="{{ route('koor.peminjaman.index') }}" class="btn-kembali-1" style=margin-top:20px;">Kembali</a>
            </center>
        </div>
    </div>
</div>
@endsection 