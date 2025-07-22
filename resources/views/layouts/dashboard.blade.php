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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    <div class="fixed inset-0 -z-10 w-full h-full" style="background: url('/image/2f62a9e4e4228410b9e75c7048295b5b.jpg') center center / cover no-repeat;"></div>
    <div class="nocaret">
    <div class="dashboard-bg">
        <div id="navbarSpoiler" class="navbar-spoiler">
            <span class="navbar-spoiler-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ed1c24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
        </div>
        <nav class="navbar-dashboard" id="navbar-dashboard">
            <div class="navbar-profile">
                <button class="profile-btn" id="openProfileModal">
                    @if(Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="profile-avatar" style="width:40px; height:40px; border-radius:50%; object-fit:cover; margin-right:8px;">
                    @else
                        <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                    @endif
                    <span>{{ Auth::user()->name }}</span>
                </button>
            </div>
            <div style="flex:1; display:flex; justify-content:center; align-items:center; gap:12px;">
                @if(Auth::user()->role === 'koor')
                    <div style="flex:1; display:flex; align-items:center; justify-content:flex-end;">
                    </div>
                    <div style="flex:0 0 auto; display:flex; align-items:center; justify-content:center;">
                        <a href='{{ url('/dashboard') }}' class='profile-btn home-btn-navbar'>
                            <span style='display:inline-block; vertical-align:middle; margin-right:7px;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='#fff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M3 12L12 3l9 9'/><path d='M9 21V9h6v12'/></svg>
                            </span>Home
                        </a>
                    </div>
                    <div style="flex:1; display:flex; align-items:center; justify-content:flex-start;">
                    </div>
                    <div style="flex:0 0 auto; display:flex; align-items:center; justify-content:flex-end; margin-left:auto;">
                        <a href='#' class='profile-btn' id='notifBell' style='position:relative;'>
                            <span style='display:inline-block; vertical-align:middle;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' viewBox='0 0 24 24' fill='none' stroke='#00AEEF' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'><path d='M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9'/><path d='M13.73 21a2 2 0 0 1-3.46 0'/></svg>
                            </span>
                            @php $notifCount = (isset($pendingCount) ? $pendingCount : 0) + (isset($lateCount) ? $lateCount : 0); @endphp
                            @if($notifCount > 0)
                                <span style='position:absolute; top:0; right:0; background:#ed1c24; color:#fff; border-radius:50%; font-size:12px; padding:2px 7px; min-width:22px; text-align:center; font-weight:700;'>{{ $notifCount }}</span>
                            @endif
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}" class="profile-btn home-btn-navbar">
                        <span style='display:inline-block; vertical-align:middle; margin-right:7px;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='#fff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M3 12L12 3l9 9'/><path d='M9 21V9h6v12'/></svg>
                        </span>Home
                    </a>
                @endif
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
    <div class="modal-profile-bg" id="modalProfileBg">
        <div class="modal-profile" id="modalProfileBox">
            <div style="text-align:center; margin-bottom:18px;">
                @if(Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" style="width:64px; height:64px; border-radius:50%; object-fit:cover;">
                @else
                    <span class="profile-avatar" style="width:64px; height:64px; font-size:32px; display:inline-flex; align-items:center; justify-content:center;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                @endif
            </div>
            <h2 style="text-align:center; margin-bottom: 24px;">Profile</h2>
            <div class="profile-overview-table">
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">👤</span>
                    <span class="profile-info-label">Nama</span>
                    <span class="profile-info-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">✉</span>
                    <span class="profile-info-label">Email</span>
                    <span class="profile-info-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="profile-overview-row">
                    <span class="profile-overview-icon">🛡</span>
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
                <button type="button" class="btn-detail-profile" onclick="goToProfileEdit()">Edit Profile</button>
            </div>
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
            window.location.href = "{{ route('profile.edit') }}";
        }
        function goToProfileEdit() {
            closeProfileModal();
            window.location.href = "{{ route('profile.edit') }}";
        }
        // Nonaktifkan modal profile jika sedang di halaman edit profile
        @if (!request()->routeIs('profile.edit'))
            document.getElementById('openProfileModal').onclick = openProfileModal;
        @else
            document.getElementById('openProfileModal').onclick = function(e) { e.preventDefault(); };
        @endif
        document.getElementById('modalProfileBg').onclick = function(e) {
            if (e.target === this) closeProfileModal();
        };
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeProfileModal();
        });
    </script>
</body>
</html>