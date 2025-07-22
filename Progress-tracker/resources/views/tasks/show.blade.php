@extends('layouts.dashboard')

@section('title', 'Detail Pekerjaan')

@section('content')
<link rel="stylesheet" href="/css/edit-progress.css" />
<div class="edit-task-wrapper">
    <div class="card edit-task-card">
        <div class="card-header">Detail Pekerjaan</div>
        <div>
            <div class="form-group">
                <label>Nama Pekerjaan</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $task->nama }}</div>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <div class="form-control" style="background:#f8f9fa;white-space:pre-line;">{{ $task->deskripsi }}</div>
            </div>
            <div class="form-group">
                <label>Tenggat Waktu</label>
                <div class="form-control" style="background:#f8f9fa;">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</div>
            </div>
            <div class="form-group">
                <label>PIC</label>
                <div class="form-control" style="background:#f8f9fa;">{{ $task->pic }}</div>
            </div>
            <div class="form-group">
                <label>Progress</label>
                <div style="display:flex;align-items:center;gap:10px;">
                    @php
                        $progressClass = 'progress-red';
                        if ($task->progress >= 70) $progressClass = 'progress-green';
                        elseif ($task->progress >= 40) $progressClass = 'progress-yellow';
                    @endphp
                    <span class="task-progress-bar"><span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span></span>
                    <span class="task-progress-value">{{ $task->progress }}%</span>
                </div>
            </div>
            <div class="form-group">
                <label>Lampiran</label>
                @if($task->file)
                    <p class="file-info"><a href="{{ asset('storage/'.$task->file) }}" target="_blank">Download Lampiran</a></p>
                @else
                    <span class="file-info">Tidak ada lampiran</span>
                @endif
            </div>
        </div>
        <div style="text-align:center;">
            @if(Auth::user()->role === 'user')
                <a href="{{ route('ict.dashboard') }}" class="save-task-btn" style="width:auto;display:inline-block;">Kembali</a>
            @else
                <a href="{{ route('koor.progress') }}" class="save-task-btn" style="width:auto;display:inline-block;">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection 