@extends('layouts.dashboard')

@section('title', 'Edit Pekerjaan')

@section('content') 
{{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}
<link rel="stylesheet" href="/css/edit-progress.css" />
<div class="edit-task-wrapper">
    <div class="card edit-task-card">
        <div class="card-header">Ubah Pekerjaan</div>
        @if ($errors->any())
            <div class="invalid-feedback">
                <ul class="list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if(Auth::user()->role === 'ICT')
                <div class="form-group">
                    <label>Nama Pekerjaan</label>
                    <input type="text" value="{{ $task->nama }}" class="form-control" readonly disabled>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" readonly disabled>{{ $task->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label>Tenggat Waktu</label>
                    <input type="date" value="{{ $task->tenggat_waktu }}" class="form-control" readonly disabled>
                </div>
                <div class="form-group">
                    <label>PIC (Penanggung Jawab)</label>
                    <input type="text" value="{{ $task->pic }}" class="form-control" readonly disabled>
                </div>
                <div class="form-group">
                    <label>Progress (%)</label>
                    <input type="number" name="progress" min="0" max="100" value="{{ old('progress', $task->progress) }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Lampiran (opsional)</label>
                    <input type="file" name="file" class="form-control">
                </div>
            @else
                <div class="form-group">
                    <label>Nama Pekerjaan</label>
                    <input type="text" name="nama" value="{{ old('nama', $task->nama) }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $task->deskripsi) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Tenggat Waktu</label>
                    <input type="date" name="tenggat_waktu" value="{{ old('tenggat_waktu', $task->tenggat_waktu) }}" class="form-control" required>
                </div>
                @if(Auth::user()->role === 'ICT')
                    <div class="form-group">
                        <label>PIC (Penanggung Jawab)</label>
                        <input type="text" value="{{ $task->pic }}" class="form-control" readonly disabled>
                    </div>
                @else
                    <div class="form-group">
                        <label>PIC (Penanggung Jawab)</label>
                        <select name="pic" class="form-control" required>
                            <option value="">-- Pilih PIC --</option>
                            @foreach($ictUsers as $user)
                                <option value="{{ $user->name }}" {{ old('pic', $task->pic) == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label>Progress (%)</label>
                    <input type="number" name="progress" min="0" max="100" value="{{ old('progress', $task->progress) }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Lampiran (opsional)</label>
                    <input type="file" name="file" class="form-control">
                </div>
            @endif
            <button type="submit" class="save-task-btn">Update</button>
            @if(!(Auth::user()->role === 'user' || Auth::user()->role === 'ICT'))
            <a href="{{ route('koor.progress') }}" class="save-task-btn" style="width:auto;display:inline-block;margin-top:10px;text-align:center;">Kembali</a>
            @endif
        </form>
    </div>
</div>
@endsection 