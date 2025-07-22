@extends('layouts.dashboard')

@section('title', 'Preview PDF Progress')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/progress.css" />
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-blue-50 to-red-50 py-12 px-4">
    <div class="bg-white p-0 rounded-2xl shadow-2xl w-full max-w-2xl border-2 border-blue-200">
        <div class="rounded-t-2xl bg-gradient-to-r from-red-600 to-red-400 px-8 py-6 text-center">
            <div class="text-5xl mb-2 text-white drop-shadow">📄</div>
            <h2 class="text-3xl font-extrabold text-white mb-2 drop-shadow">Preview PDF Progress</h2>
            <p class="text-blue-100">Detail pekerjaan dan preview PDF lampiran</p>
        </div>
        <div class="space-y-6 px-8 py-8">
            <div>
                <div class="task-label">Nama Pekerjaan</div>
                <div class="task-value">{{ $task->nama }}</div>
            </div>
            <div>
                <div class="task-label">Deskripsi</div>
                <div class="task-desc">{{ $task->deskripsi }}</div>
            </div>
            <div class="task-row">
                <div class="task-row-col">
                    <div class="task-label">Tenggat Waktu</div>
                    <div class="task-desc">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</div>
                </div>
                <div class="task-row-col">
                    <div class="task-label">PIC</div>
                    <div class="task-desc">{{ $task->pic }}</div>
                </div>
            </div>
            <div>
                <div class="task-label">Progress</div>
                @php
                    $progressClass = 'progress-red';
                    if ($task->progress >= 70) $progressClass = 'progress-green';
                    elseif ($task->progress >= 40) $progressClass = 'progress-yellow';
                @endphp
                <span class="task-progress-bar"><span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span></span>
                <span class="task-progress-value">{{ $task->progress }}%</span>
            </div>
            <div>
                <div class="task-label">Lampiran PDF</div>
                @if($task->file && \Illuminate\Support\Str::endsWith(strtolower($task->file), '.pdf'))
                    <div style="border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; margin-top:12px;">
                        <iframe src="{{ asset('storage/'.$task->file) }}" width="100%" height="600px" style="border:0;"></iframe>
                    </div>
                    <div class="mt-2">
                        <a href="{{ asset('storage/'.$task->file) }}" target="_blank" class="task-attachment-link">Download PDF</a>
                    </div>
                @else
                    <span class="task-no-attachment">Tidak ada lampiran PDF</span>
                @endif
            </div>
        </div>
        <div style="text-align:center;">
            <a href="{{ url()->previous() }}" class="task-back-btn">⬅️ Kembali</a>
        </div>
    </div>
</div>
@endsection 