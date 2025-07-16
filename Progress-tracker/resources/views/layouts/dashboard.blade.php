<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans:400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sansation:400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/register.css" />
    <link rel="stylesheet" href="/css/layouts.css" />
</head>
<body>
    <div class="dashboard-bg">
        <div id="navbarSpoiler" class="navbar-spoiler">
            <span class="navbar-spoiler-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ed1c24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
        </div>
        <nav class="navbar-dashboard" id="navbar-dashboard">
            <div class="navbar-profile">
                <button class="profile-btn" id="openProfileModal">
                    <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                    <span>{{ Auth::user()->name }}</span>
                </button>
            </div>
            <div style="flex:1; display:flex; justify-content:center;">
                <a href="{{ url('/dashboard') }}" class="profile-btn home-btn-navbar" style="margin:0 12px;">
                    <span style="display:inline-block; vertical-align:middle; margin-right:7px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12L12 3l9 9"/><path d="M9 21V9h6v12"/></svg>
                    </span>Home
                </a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="profile-btn logout-btn-navbar">
                    <span style="display:inline-block; vertical-align:middle; margin-right:7px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </span>Logout
                </button>
            </form>
        </nav>
        <div class="dashboard-content">
            @yield('content')
        </div>
    </div>
    <!-- Modal Profile -->
    <div class="modal-profile-bg" id="modalProfileBg">
        <div class="modal-profile" id="modalProfileBox">
            <h2 style="text-align:center; margin-bottom: 24px;">Profile</h2>
            <div class="profile-overview-table">
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">👤</span>
                    <span class="profile-info-label">Nama</span>
                    <span class="profile-info-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">✉️</span>
                    <span class="profile-info-label">Email</span>
                    <span class="profile-info-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">🛡️</span>
                    <span class="profile-info-label">Division</span>
                    <span class="profile-info-value">{{ Auth::user()->role }}</span>
                </div>
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">📅</span>
                    <span class="profile-info-label">Bergabung</span>
                    <span class="profile-info-value">{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div style="text-align:center;">
                <button type="button" class="btn-detail-profile" onclick="goToProfileDetail()">Lihat Detail</button>
            </div>
        </div>
    </div>
    <script>
        function openProfileModal() {
            document.getElementById('modalProfileBg').classList.add('active');
        }
        function closeProfileModal() {
            document.getElementById('modalProfileBg').classList.remove('active');
        }
        function goToProfileDetail() {
            closeProfileModal();
            window.location.href = "{{ route('profile.show') }}";
        }
        document.getElementById('openProfileModal').onclick = openProfileModal;
        document.getElementById('modalProfileBg').onclick = function(e) {
            if (e.target === this) closeProfileModal();
        };
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeProfileModal();
        });
    </script>
</body>
</html> 