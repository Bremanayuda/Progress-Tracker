@extends('layouts.dashboard')

@section('title', 'Dashboard ' . Auth::user()->role)

@section('content')
<div class="wrapper">
    <header class="header-2">
    </header>
        
    <main class="main-content">

    </main>
  </div>

<footer class="footer">
  <img src="/image/logo.png" alt="Logo" class="footer-logo">
  <p class="footer-text">ICT SUPPORT</p>
</footer>

    
@endsection 