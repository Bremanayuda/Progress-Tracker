@extends('layouts.dashboard')

@section('title', 'Progress ICT')

@section('content') 
<link rel="stylesheet" href="/css/progress.css" />
<div class="container mx-auto py-8 px-4">
    <div class="daftar-progress">
        {{-- <div class="flex justify-between items-center mb-8"></div> --}}
            {{-- <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-4 border-b border-red-200 flex items-center gap-2"> --}}
                <h2 class="daftar-perogress">Daftar Pekerjaan</h2>
            </div>
            <div class="p-6">
                @if(isset($tasks) && $tasks->count())
                <div class="table-wrapper">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Tenggat Waktu</th>
                                <th>PIC</th>
                                <th>Progress</th>
                                <th>Lampiran</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            @php
                                $progressClass = 'progress-red';
                                if ($task->progress >= 70) $progressClass = 'progress-green';
                                elseif ($task->progress >= 40) $progressClass = 'progress-yellow';
                            @endphp
                            <tr>
                                <td>{{ $task->nama }}</td>
                                <td>{{ Str::limit($task->deskripsi, 50) }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</td>
                                <td>{{ $task->pic }}</td>
                                <td class="text-center">
                                    <span class="task-progress-bar">
                                        <span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span>
                                    </span>
                                    <span class="task-progress-value">{{ $task->progress }}%</span>
                                </td>
                                <td class="text-center">
                                                <a href="{{ route('tasks.download_pdf_progress', $task) }}" class="btn-download">Download</a>
                                </td> 
                                <td class="text-center">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Lihat</a>
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
@endsection 