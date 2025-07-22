<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laporan Progress Kerja') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen relative overflow-x-hidden bg-white">
    @if (in_array(request()->route()->getName(), ['login', 'register']))
    <div class="fixed inset-0 -z-10" style="background: url('image/image_1.jpg') center center / cover no-repeat;">
        <div class="absolute inset-0" style="backdrop-filter: blur(0.1px);"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-white/90 via-blue-50/80 to-red-50/80"></div>
    </div>
    @elseif (!in_array(request()->route()->getName(), ['tasks.create', 'tasks.edit', 'tasks.show']))
    <div class="fixed inset-0 -z-10" style="background: url('/image/2f62a9e4e4228410b9e75c7048295b5b.jpg') center center / cover no-repeat;">
        <div class="absolute inset-0" style="backdrop-filter: blur(0.1px);"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-white/90 via-blue-50/80 to-red-50/80"></div>
    </div>
    @endif
    @if (!in_array(request()->route()->getName(), ['login', 'register']))
    <nav class="bg-white border-b-2 border-blue-200 shadow-lg mb-8 animate__animated animate__fadeInDown flex items-center justify-between py-4 px-8">
        <div class="flex items-center gap-4">
            <img src="/PEPC.png" alt="Pertamina" class="h-10">
            <span id="typing-navbar" class="text-2xl font-extrabold text-blue-700 border-r-2 border-blue-700 animate__animated animate__fadeIn"></span>
        </div>
        @auth
        <form action="/logout" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-blue-700 px-4 py-2 rounded-lg text-white hover:bg-blue-800 transition duration-200 shadow-md font-bold text-sm flex items-center gap-2">
                <span>Logout</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v1" /></svg>
            </button>
        </form>
        @endauth
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.getElementById('typing-navbar')) {
                    const text = 'Laporan Progress Kerja';
                    const typingText = document.getElementById('typing-navbar');
                    let i = 0;
                    function type() {
                        if (i <= text.length) {
                            typingText.textContent = text.substring(0, i);
                            i++;
                            setTimeout(type, 120);
                        } else {
                            setTimeout(() => {
                                i = 0;
                                type();
                            }, 1200);
                        }
                    }
                    type();
                }
            });
        </script>
    </nav>
    @endif
    <main class="relative z-10">
        @yield('content')
    </main>
</body>
</html> 