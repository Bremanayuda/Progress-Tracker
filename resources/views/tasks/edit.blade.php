@extends('layouts.dashboard')

@section('title', 'Edit Pekerjaan')

@section('content') 
<link rel="stylesheet" href="/css/edit-progress.css" />
<div class="edit-task-wrapper">
    <div class="card edit-task-card">
        <div class="card-header">Pekerjaan</div>
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
                    <label>Lampiran (link, opsional)</label>
                    <input type="url" name="file_link" class="form-control" placeholder="Masukkan link lampiran (opsional)" value="{{ old('file_link', $task->file_link ?? '') }}">
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
                        @php
                            $selectedPics = old('pic', $task->pic);
                            if (is_string($selectedPics)) {
                                $selectedPics = json_decode($selectedPics, true);
                            }
                            if (!is_array($selectedPics)) {
                                $selectedPics = [$selectedPics];
                            }
                        @endphp
                        <select name="pic[]" multiple class="form-control" required id="pic-select">
                            @foreach($ictUsers as $user)
                                <option value="{{ $user->name }}" {{ in_array($user->name, $selectedPics) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                            <option value="other" {{ in_array('other', $selectedPics) ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="pic_other" id="pic-other-input" class="form-control mt-2" placeholder="Isi PIC lain (pisahkan dengan koma)" style="display:none;" value="{{ old('pic_other') }}">
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
                <div class="form-group">
                    <label>Progress (%)</label>
                    <input type="number" name="progress" min="0" max="100" value="{{ old('progress', $task->progress) }}" class="form-control" required>
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