@extends('layouts.dashboard')

@section('title', 'Dashboard Koor')

@section('content')
<link rel="stylesheet" href="/css/koor-barang.css">
<link rel="stylesheet" href="/css/koor-dashboard.css"> 
<div class="fixed inset-0 -z-10 w-full h-full" style="background: url('/image/2f62a9e4e4228410b9e75c7048295b5b.jpg') center center / cover no-repeat;"></div>
    <div id="notifModal" style="display:none; position:fixed; top:70px; right:40px; z-index:9999; background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.13); min-width:320px; max-width:90vw; padding:18px 20px;">
        <div style="font-weight:700; font-size:17px; margin-bottom:10px; color:#ed1c24;">Notifikasi</div>
        <div style="margin-bottom:10px;">
            <b>Pengajuan Baru:</b> {{ $pendingCount }}<br>
            <b>Telat Deadline:</b> {{ $lateCount }}
        </div>
        <div style="text-align:right;">
            <button onclick="document.getElementById('notifModal').style.display='none'" style="background:#ed1c24; color:#fff; border:none; border-radius:7px; padding:6px 16px; font-weight:600; cursor:pointer;">Tutup</button>
        </div>
    </div>
</div>

<div class="nocaret">
<div class="dashboard-retangle-wrapper">
  <div class="dashboard-retangle">
    <img class="logo-pertamina" src="/image/Logo.png" alt="Logo Pertamina" />
    <nav class="navigation">
      <a href="{{ route('koor.peminjaman.page') }}" class="button peminjaman">PEMINJAMAN</a>
      <a href="{{ route('koor.progress') }}" class="button peminjaman">PROGRESS</a>
    </nav>
    </div>
  </div>
</div>

<script>
    document.getElementById('notifBell')?.addEventListener('click', function(e) {
        e.preventDefault();
        var modal = document.getElementById('notifModal');
        if(modal.style.display === 'none' || modal.style.display === '') {
            modal.style.display = 'block';
        } else {
            modal.style.display = 'none';
        }
    });
    document.addEventListener('click', function(e) {
        var modal = document.getElementById('notifModal');
        var bell = document.getElementById('notifBell');
        if(modal && bell && !modal.contains(e.target) && !bell.contains(e.target)) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection 