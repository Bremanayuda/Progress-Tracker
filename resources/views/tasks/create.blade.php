@extends('layouts.dashboard')

@section('title', 'Tambah Pekerjaan')

@section('content')
<link rel="stylesheet" href="/css/table-style.css" />
<div class="form-container animate__animated animate__slideInUp" style="position: relative; z-index: 1;">
    <div class="form-header">
        <span class="text-5xl"></span>
        <h2>Task</h2>
    </div>
 
    @if ($errors->any())
        <div class="form-error animate__animated animate__shakeX">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="form-group">
            <label>Nama Pekerjaan</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </div>
            <div>
                <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Deskripsi</label>
                <textarea name="deskripsi" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" required>{{ old('deskripsi') }}</textarea>
            </div>
            <div class="flex flex-wrap gap-8">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Tenggat Waktu</label>
                    <input type="date" name="tenggat_waktu" value="{{ old('tenggat_waktu') }}" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" required>
                </div>
                @if(Auth::user()->role === 'ICT')
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">PIC (Penanggung Jawab)</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl bg-gray-100" readonly disabled>
                    </div>
                @else
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">PIC (Penanggung Jawab)</label>
                        <select name="pic[]" multiple class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" required id="pic-select">
                            @foreach($ictUsers as $user)
                                <option value="{{ $user->name }}" {{ (collect(old('pic'))->contains($user->name)) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                            <option value="other" {{ (collect(old('pic'))->contains('other')) ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="pic_other" id="pic-other-input" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl mt-2" placeholder="Isi PIC lain (pisahkan dengan koma)" style="display:none;" value="{{ old('pic_other') }}">
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const select = document.getElementById('pic-select');
                                const otherInput = document.getElementById('pic-other-input');
                                function toggleOtherInput() {
                                    const selected = Array.from(select.selectedOptions).map(opt => opt.value);
                                    if (selected.includes('other')) {
                                        otherInput.style.display = '';
                                    } else {
                                        otherInput.style.display = 'none';
                                        otherInput.value = '';
                                    }
                                }
                                select.addEventListener('change', toggleOtherInput);
                                toggleOtherInput();
                            });
                        </script>
                    </div>
                @endif
            </div>
            <div>
                <label class="block text-blue-700 font-bold mb-2 uppercase tracking-wide">Progress (%)</label>
                <input type="number" name="progress" min="0" max="100" value="{{ old('progress', 0) }}" class="w-full px-5 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 font-semibold text-lg shadow-sm" required>
            </div>
            <div class="flex justify-center gap-4 mt-2">
                <button type="submit" class="simpan-btn">Simpan</button>
                <a href="{{ route('dashboard') }}" class="simpan-btn">Kembali ke Dashboard</a>
            </div>
                

        </form>
    </div>
</div>
@endsection 