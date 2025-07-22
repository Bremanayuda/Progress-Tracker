@extends('layouts.dashboard')

@section('title', 'Progress ICT')

@section('content') 
<link rel="stylesheet" href="/css/progress.css" />
<div class="fixed inset-0 -z-10 w-full h-full" style="background: url('/image/2f62a9e4e4228410b9e75c7048295b5b.jpg') center center / cover no-repeat;"></div>
<div class="container mx-auto py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-2xl border-2 border-blue-200 overflow-hidden animate__animated animate__fadeInUp px-10 py-8">
            <div class="flex items-center gap-3 mb-6 bg-blue-50 border-b-2 border-blue-200 px-6 py-4 rounded-t-2xl">
                <span class="text-2xl">📋</span>
                <h2 class="text-2xl font-bold text-blue-700">Daftar Pekerjaan</h2>
            </div>
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
                                <th class="py-4 px-6 text-center font-bold text-base">Lampiran</th>
                                <th class="py-4 px-6 text-center font-bold text-base"></th>
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
                                            @if(trim($pic) === Auth::user()->name)
                                                <span style="display:inline-block; background:#2563eb; color:#fff; font-weight:600; border-radius:20px; padding:6px 18px; font-size:1rem; box-shadow:0 1px 3px #0001;">{{ $pic }}</span>
                                            @else
                                                <span style="display:inline-block; background:#e0edff; color:#2563eb; font-weight:600; border-radius:20px; padding:6px 18px; font-size:1rem; box-shadow:0 1px 3px #0001;">{{ $pic }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="task-progress-bar">
                                        <span class="task-progress-inner {{ $progressClass }}" style="width: {{ $task->progress }}%"></span>
                                    </span>
                                    <span class="task-progress-value">{{ $task->progress }}%</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                        <a href="{{ route('tasks.download_pdf_progress', $task->id) }}" class="btn-download">Download</a>  
                                </td>
                                <td class="py-4 px-6 text-center">
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