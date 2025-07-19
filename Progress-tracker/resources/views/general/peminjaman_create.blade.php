@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/peminjaman.css">
<div class="edit-profile-wrapper">
    <div class="card edit-profile-card" style="width: 100%; max-width: 480px;">
        <div class="card-header">Form Peminjaman Barang</div>
        <div class="card-body">
            <form method="POST" action="{{ route('general.peminjaman.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label>Nama Peminjam</label>
                    <div class="form-control" style="background:#f8f9fa;">{{ Auth::user()->name }}</div>
                </div>
                <div class="form-group mb-3">
                    <label>Divisi</label>
                    <div class="form-control" style="background:#f8f9fa;">{{ Auth::user()->role }}</div>
                </div>
                <div class="form-group mb-3">
                    <label for="barang_id">Pilih Barang</label>
                    <select id="barang_id" name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="jumlah_pinjam">Jumlah Pinjam</label>
                    <input id="jumlah_pinjam" type="number" class="form-control @error('jumlah_pinjam') is-invalid @enderror" name="jumlah_pinjam" min="1" value="1" required placeholder="Masukkan jumlah yang ingin dipinjam">
                    @error('jumlah_pinjam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal_pinjam">Tanggal Pinjam Dari</label>
                    <input id="tanggal_pinjam" type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" required>
                    @error('tanggal_pinjam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal_kembali">Tanggal Pinjam Hingga</label>
                    <input id="tanggal_kembali" type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" required>
                    @error('tanggal_kembali')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="alasan">Alasan Peminjaman</label>
                    <textarea id="alasan" class="form-control @error('alasan') is-invalid @enderror" name="alasan" rows="3" required></textarea>
                    @error('alasan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="save-profile-btn">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 