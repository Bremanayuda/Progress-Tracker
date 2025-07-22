@extends('layouts.dashboard')

@section('title', 'Progress Tracking')

@section('content')
{{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}
<link rel="stylesheet" href="/css/progress.css" />
<div class="slide-page">
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-4">
                    <div class="rounded-xl bg-gradient-to-r from-red-600 to-red-400 p-4 shadow-lg">
                        <span class="text-4xl text-white drop-shadow"></span>
                    </div>
                    <div class="daftar-progress slide-title">
                    <h2>Daftar Progress</h2>
                    </div>
                @if(session('success'))
                    <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center animate__animated animate__fadeInDown">
                        <span class="mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                <div class="p-6">
                    @if(isset($tasks) && $tasks->count())
                    <div class="table-wrapper slide-table">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-gradient-to-r from-red-100 to-red-200 text-red-800">
                                    <th class="py-4 px-6 text-left font-bold">Nama</th>
                                    <th class="py-4 px-6 text-left font-bold">Deskripsi</th>
                                    <th class="py-4 px-6 text-left font-bold">Tenggat Waktu</th>
                                    <th class="py-4 px-6 text-left font-bold">PIC</th>
                                    <th class="py-4 px-6 text-center font-bold">Progress</th>
                                    <th class="py-4 px-6 text-center font-bold">Laporan</th>
                                    <th class="py-4 px-6 text-center font-bold">Aksi</th>
                                    <th class="py-4 px-6 text-center font-bold">Hapus</th>
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
                                    <td class="py-4 px-6 font-semibold text-gray-900">{{ $task->nama }}</td>
                                    <td class="py-4 px-6 text-gray-700">{{ Str::limit($task->deskripsi, 50) }}</td>
                                    <td class="py-4 px-6 text-gray-700">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6 text-gray-700">{{ $task->pic }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <div>
                                            <span class="task-progress-bar">
                                                <span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span>
                                            </span>
                                            <span class="task-progress-value">{{ $task->progress }}%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if($task->progress == 100)
                                            <a href="{{ route('tasks.download_pdf_progress', $task) }}" class="btn-download">Download</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center" colspan="1">
                                        <div class="aksi-btn-group"> <!-- gunakan class flex custom agar tombol benar-benar bersebelahan -->
                                            <a href="{{ route('tasks.show', $task) }}" 
                                               class="btn-mini" 
                                               title="Lihat Detail">Lihat</a>
                                            <a href="{{ route('tasks.edit', $task) }}" 
                                               class="btn-mini">Edit</a>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus progress ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-edit">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

        </div>
        <div class="koor-progress-bottom-btns slide-btns">
            <a href="{{ route('dashboard') }}" class="tambah-progress">Kembali</a>
            <a href="{{ route('tasks.create') }}" class="tambah-progress">Tambah Progress</a>
        </div> 


                </div> 
                @else
                <div class="table-wrapper animate__animated animate__fadeIn animate__delay-1s">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-100 to-red-200 text-red-800">
                                <th class="py-4 px-6 text-left font-bold">Nama</th>
                                <th class="py-4 px-6 text-left font-bold">Deskripsi</th>
                                <th class="py-4 px-6 text-left font-bold">Tenggat Waktu</th>
                                <th class="py-4 px-6 text-left font-bold">PIC</th>
                                <th class="py-4 px-6 text-center font-bold">Progress</th>
                                <th class="py-4 px-6 text-center font-bold">Laporan</th>
                                <th class="py-4 px-6 text-center font-bold">Aksi</th>
                                <th class="py-4 px-6 text-center font-bold">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="text-center text-gray-400 py-8">Belum ada progress yang ditambahkan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="koor-progress-bottom-btns flex justify-center gap-4 mt-6">
                    <a href="{{ route('dashboard') }}" class="tambah-progress">Kembali ke Dashboard</a>
                    <a href="{{ route('tasks.create') }}" class="tambah-progress">Tambah Progress</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
