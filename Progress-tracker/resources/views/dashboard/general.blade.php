@extends('layouts.dashboard')

@section('title', 'Dashboard ' . Auth::user()->role)

@section('content')
<div class="dashboard-container">
    <div class="welcome-section">
    </div>

    
@endsection 