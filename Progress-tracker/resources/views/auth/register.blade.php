@extends('layouts.app')

@section('content')
<style>
@keyframes gradientMove {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
.animated-bg-gradient {
  background: linear-gradient(120deg, #fff9, #dbeafecc 50%, #fecaca99 100%);
  background-size: 200% 200%;
  animation: gradientMove 10s ease-in-out infinite;
}
</style>
<div class="min-h-screen flex items-center justify-center relative overflow-hidden" style="background: url('/image_1.jpg') center center / cover no-repeat;">
    <div class="absolute inset-0" style="backdrop-filter: blur(0.1px);"></div>
    <div class="absolute inset-0 animated-bg-gradient"></div>
    <div class="w-full max-w-xl relative z-10 animate__animated animate__fadeIn my-auto min-h-[80vh] flex flex-col justify-center">
        <div class="bg-white border-2 border-blue-200 rounded-2xl shadow-2xl px-16 py-12">
            <div class="flex flex-col items-center mb-8">
                <img src="image/PEPC.png" alt="Pertamina" class="h-12 mb-4">
                <h2 class="text-2xl font-extrabold text-blue-700 mb-2">
                    <span id="typing-text" class="border-r-2 border-blue-700 animate__animated animate__fadeIn"></span>
                </h2>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const text = 'Laporan Progress Kerja';
                    const typingText = document.getElementById('typing-text');
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
                });
            </script>
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg animate__animated animate__shakeX">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}" class="space-y-8">
                @csrf
                <div>
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" placeholder="Masukkan nama lengkap" required>
                </div>
                <div>
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" placeholder="contoh@email.com" required>
                </div>
                <div>
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Password</label>
                    <input type="password" name="password" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" placeholder="Minimal 6 karakter" required>
                </div>
                <div>
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" placeholder="Ulangi password" required>
                </div>
                <div>
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Role</label>
                    <select name="role" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" required>
                        <option value="role1" {{ old('role') == 'role1' ? 'selected' : '' }}>👤 ICT</option>
                        <option value="role2" {{ old('role') == 'role2' ? 'selected' : '' }}>🏢 SCM</option>
                        <option value="role3" {{ old('role') == 'role3' ? 'selected' : '' }}>🛡️ HSSE</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 font-bold text-lg shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">Daftar Sekarang</button>
            </form>
            <div class="mt-8 text-center text-gray-600">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline ml-1 animate__animated animate__pulse animate__infinite">Login di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
