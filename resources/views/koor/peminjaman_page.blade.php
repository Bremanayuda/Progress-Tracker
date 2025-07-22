@extends('layouts.dashboard')

@section('title', 'Halaman Peminjaman')

@section('content')
<link rel="stylesheet" href="/css/koor-barang.css">
<link rel="stylesheet" href="/css/koor-dashboard.css">

<div class="nocaret peminjaman-page">
<div class="dashboard-retangle-wrapper">
  <div class="dashboard-retangle">
    <img class="logo-pertamina" src="/image/Logo.png" alt="Logo Pertamina" /> 
    <div class="kotak1">
      <a href="{{ route('koor.barang.index') }}">
        <img class="gudang" src="/image/gudang.jpg" alt="Daftar Barang">
      </a>
      <p class="label-box">Daftar Barang</p>
    </div>
    <div class="kotak2">
      <a href="{{ route('koor.peminjaman.index') }}">
        <img class="riwayat" src="/image/riwayat.jpg" alt="Riwayat Peminjaman">
      </a>
       <p class="label-box">Daftar Peminjaman</p> 
    </div>
    <div class="navigation">
      <a href="{{ route('dashboard') }}" class="button peminjaman" style="color: 	#ffffff">
        Kembali ke Dashboard
      </a>
    </div>
  </div>
</div>
</div>

@endsection 