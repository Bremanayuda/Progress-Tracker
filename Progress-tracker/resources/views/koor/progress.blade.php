@extends('layouts.dashboard')

@section('title', 'Progress Tracking')

@section('content')
<link rel="stylesheet" href="/css/progress.css" />
<div class="fixed inset-0 -z-10 w-full h-full" style="background: url('/image/2f62a9e4e4228410b9e75c7048295b5b.jpg') center center / cover no-repeat;"></div>
<div class="relative min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <h1 class="text-4xl font-extrabold text-white drop-shadow">Progres Kinerja</h1>
                <a href="{{ route('tasks.create') }}" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-lg flex items-center font-bold text-lg transform hover:scale-105 animate__animated animate__fadeInRight">
                    <span class="mr-2 text-2xl">＋</span> Tambah Pekerjaan
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-blue-200 overflow-hidden animate__animated animate__fadeInUp px-10 py-8">
                <div class="flex items-center gap-3 mb-6 bg-blue-50 border-b-2 border-blue-200 px-6 py-4 rounded-t-2xl">
                    <span class="text-2xl">📋</span>
                    <h2 class="text-2xl font-bold text-blue-700">Daftar Pekerjaan</h2>
                </div>
                @if(session('success'))
                    <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center animate__animated animate__fadeInDown">
                        <span class="mr-2">✅</span> {{ session('success') }}
                    </div>
                @endif
                <div class="p-2">
                    @if(isset($tasks) && $tasks->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-xl overflow-hidden">
                            <thead>
                            <tr class="bg-blue-100 text-blue-800">
                                    <th class="py-4 px-6 text-left font-bold text-base">Nama</th>
                                    <th class="py-4 px-6 text-left font-bold text-base">Deskripsi</th>
                                    <th class="py-4 px-6 text-left font-bold text-base">Tenggat Waktu</th>
                                    <th class="py-4 px-6 text-left font-bold text-base">PIC</th>
                                    <th class="py-4 px-6 text-center font-bold text-base">Progress</th>
                                    <th class="py-4 px-6 text-center font-bold text-base">Laporan</th>
                                    <th class="py-4 px-6 text-center font-bold text-base">Aksi</th>
                                    <th class="py-4 px-6 text-center font-bold text-base">Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($tasks as $task)
                                @php
                                    $progressClass = 'progress-red';
                                    if ($task->progress >= 70) $progressClass = 'progress-green';
                                    elseif ($task->progress >= 40) $progressClass = 'progress-yellow';
                                @endphp
                                <tr class="hover:bg-blue-50 transition duration-150 {{ $loop->even ? 'bg-blue-50/50' : '' }} animate__animated animate__fadeInUp">
                                    <td class="py-4 px-6 font-semibold text-gray-900 whitespace-pre-line">{{ $task->nama }}</td>
                                    <td class="py-4 px-6 text-gray-700 whitespace-pre-line">{{ Str::limit($task->deskripsi, 50) }}</td>
                                    <td class="py-4 px-6 text-gray-700">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6 text-gray-700">
                                        @php
                                            $pics = $task->pic;
                                            if (is_string($pics)) {
                                                $pics = json_decode($pics, true);
                                            }
                                            if (!is_array($pics)) {
                                                $pics = [$pics];
                                            }
                                        @endphp
                                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                            @foreach($pics as $pic)
                                                <span style="display:inline-block; background:#e0edff; color:#2563eb; font-weight:600; border-radius:20px; padding:6px 18px; font-size:1rem; box-shadow:0 1px 3px #0001;">{{ $pic }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div class="w-24 bg-blue-100 rounded-full h-4 overflow-hidden border-2 border-blue-300">
                                                <div class="bg-blue-600 h-4 rounded-full transition-all duration-700" style="width: {{ $task->progress }}%"></div>
                                            </div>
                                            <span class="font-bold text-blue-700 text-base">{{ $task->progress }}%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if($task->progress == 100)
                                            <a href="{{ route('tasks.download_pdf_progress', $task) }}" class="text-blue-700 hover:text-blue-900 transition font-bold" title="Download Laporan">Download</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('tasks.show', $task) }}" class="bg-gray-200 text-blue-700 px-3 py-1 rounded-lg text-sm hover:bg-blue-100 transition duration-200 shadow-md font-bold transform hover:scale-110" title="Lihat Detail">👁️</a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-700 transition duration-200 shadow-md font-bold transform hover:scale-110">✏️ Edit</a>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pekerjaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-700 transition duration-200 shadow-md font-bold transform hover:scale-110">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-12 animate__animated animate__fadeIn animate__delay-1s">
                        <div class="text-gray-400 text-7xl mb-4">📋</div>
                        <p class="text-gray-500 text-lg font-semibold">Belum ada pekerjaan yang ditambahkan.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection