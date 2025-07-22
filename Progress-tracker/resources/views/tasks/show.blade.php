@extends('layouts.dashboard')

@section('title', 'Detail Pekerjaan')

@section('content') 
<link rel="stylesheet" href="/css/edit-progress.css" />
<div class="edit-task-wrapper">
    <div class="card edit-task-card bg-white rounded-2xl shadow-2xl border-2 border-blue-200 max-w-2xl mx-auto p-8 animate__animated animate__fadeInUp">
        <div class="card-header text-2xl font-bold text-blue-700 mb-6 flex items-center gap-3"><span class="text-3xl">📄</span> Detail Pekerjaan</div>
        <div class="space-y-4">
            <div class="form-group">
                <label class="font-bold text-blue-700">Nama Pekerjaan</label>
                <div class="form-control bg-blue-50 rounded-xl px-5 py-3 text-lg font-semibold">{{ $task->nama }}</div>
            </div>
            <div class="form-group">
                <label class="font-bold text-blue-700">Deskripsi</label>
                <div class="form-control bg-blue-50 rounded-xl px-5 py-3 whitespace-pre-line">{{ $task->deskripsi }}</div>
            </div>
            <div class="form-group">
                <label class="font-bold text-blue-700">Tenggat Waktu</label>
                <div class="form-control bg-blue-50 rounded-xl px-5 py-3">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</div>
            </div>
            <div class="form-group">
                <label class="font-bold text-blue-700">PIC</label>
                <div class="form-control bg-blue-50 rounded-xl px-5 py-3 flex flex-wrap gap-2">
                    @php
                        $pics = $task->pic;
                        if (is_string($pics)) {
                            $pics = json_decode($pics, true);
                        }
                        if (!is_array($pics)) {
                            $pics = [$pics];
                        }
                    @endphp
                    @foreach($pics as $pic)
                        @if(trim($pic) === Auth::user()->name)
                            <span style="display:inline-block; background:#2563eb; color:#fff; font-weight:600; border-radius:20px; padding:6px 18px; font-size:1rem; box-shadow:0 1px 3px #0001;">{{ $pic }}</span>
                        @else
                            <span style="display:inline-block; background:#e0edff; color:#2563eb; font-weight:600; border-radius:20px; padding:6px 18px; font-size:1rem; box-shadow:0 1px 3px #0001;">{{ $pic }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="font-bold text-blue-700">Progress</label>
                <div class="flex items-center gap-4">
                    @php
                        $progressClass = 'progress-red';
                        if ($task->progress >= 70) $progressClass = 'progress-green';
                        elseif ($task->progress >= 40) $progressClass = 'progress-yellow';
                    @endphp
                    <span class="task-progress-bar"><span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span></span>
                    <span class="task-progress-value text-lg font-bold">{{ $task->progress }}%</span>
                </div>
            </div>
            <div class="form-group">
                <label class="font-bold text-blue-700">Lampiran</label>
                @if($task->file)
                    <p class="file-info"><a href="{{ asset('storage/'.$task->file) }}" target="_blank" class="text-blue-700 font-bold underline">Download Lampiran</a></p>
                @else
                    <span class="file-info text-gray-400">Tidak ada lampiran</span>
                @endif
            </div>
        </div>
        <div class="text-center mt-8">
            @if(Auth::user()->role === 'ICT')
                <a href="{{ route('dashboard') }}" class="save-task-btn bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-lg font-bold text-lg" style="width:auto;display:inline-block;">Kembali</a>
            @else
                <a href="{{ route('koor.progress') }}" class="save-task-btn bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-lg font-bold text-lg" style="width:auto;display:inline-block;">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection 