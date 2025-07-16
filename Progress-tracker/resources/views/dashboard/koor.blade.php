@extends('layouts.dashboard')

@section('title', 'Dashboard Koor')

@section('content')
<div class="dashboard-container">
    <div class="welcome-section">
        <h1>Dashboard Koordinator</h1>
        <p>Selamat datang di Progress Tracker System</p>
    </div>

    <div class="user-info">
        <h3>Informasi User:</h3>
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
        <p><strong>Bergabung sejak:</strong> {{ Auth::user()->created_at->format('d M Y H:i') }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">15</div>
            <div class="stat-label">Total Projects</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">8</div>
            <div class="stat-label">Active Projects</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">12</div>
            <div class="stat-label">Team Members</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">85%</div>
            <div class="stat-label">Completion Rate</div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="#" class="action-btn btn-primary">Manage Projects</a>
        <a href="#" class="action-btn btn-primary">View Reports</a>
        <a href="#" class="action-btn btn-secondary">Team Management</a>
        <a href="#" class="action-btn btn-secondary">Settings</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="action-btn logout-btn">Logout</button>
        </form>
    </div>
</div>
@endsection 