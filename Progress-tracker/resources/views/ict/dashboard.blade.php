@extends('layouts.dashboard')

@section('title', 'Dashboard ' . Auth::user()->role)

@section('content')
<div class="wrapper">
    <main class="main-content" style="margin-top:32px; text-align:center;">
    </main>
</div>
<footer class="footer">
  <img src="/image/logo.png" class="footer-logo">
  <p class="footer-text">INFORMATION COMMUNICATION <br>AND TECHNOLOGY</p>
</footer>
@endsection 