<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function create()
    {
        // Hanya koor (super user) yang bisa create
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $ictUsers = User::where('role', 'ICT')->orderBy('name')->get();
        return view('tasks.create', compact('ictUsers'));
    }

    public function store(Request $request)
    {
        // Hanya koor (super user) yang bisa store
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tenggat_waktu' => 'required|date',
            'pic' => 'required|string|max:255',
            'progress' => 'required|integer|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
        ]);
        $validated['created_by'] = Auth::id();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('tasks', 'public');
        }
        Task::create($validated);
        return redirect()->route('dashboard')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    public function edit(Task $task)
    {
        // Hanya koor dan ICT yang bisa edit
        if (!in_array(Auth::user()->role, ['koor', 'ICT'])) {
            abort(403);
        }
        $ictUsers = User::where('role', 'ICT')->orderBy('name')->get();
        return view('tasks.edit', compact('task', 'ictUsers'));
    }

    public function update(Request $request, Task $task)
    {
        // Hanya koor dan ICT yang bisa update
        if (!in_array(Auth::user()->role, ['koor', 'ICT'])) {
            abort(403);
        }
        if (Auth::user()->role === 'ICT') {
            $validated = $request->validate([
                'progress' => 'required|integer|min:0|max:100',
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
            ]);
            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('tasks', 'public');
            }
            $task->update($validated);
        } else {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tenggat_waktu' => 'required|date',
                'pic' => 'required|string|max:255',
                'progress' => 'required|integer|min:0|max:100',
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
            ]);
            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('tasks', 'public');
            }
            $task->update($validated);
        }
        return redirect()->route('dashboard')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        // Hanya koor (super user) yang bisa delete
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Pekerjaan berhasil dihapus!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function progressKoor()
    {
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $tasks = Task::orderByDesc('created_at')->get();
        return view('koor.progress', compact('tasks'));
    }

    public function pdfProgress(Task $task)
    {
        // Hanya koor atau ICT yang merupakan PIC yang bisa melihat
        if (Auth::user()->role === 'ICT' && $task->pic !== Auth::user()->name) {
            abort(403);
        }
        return view('tasks.pdf_progress', compact('task'));
    }

    public function downloadPdfProgress(Task $task)
    {
        // Hanya koor atau ICT yang merupakan PIC yang bisa download
        if (Auth::user()->role === 'ICT' && $task->pic !== Auth::user()->name) {
            abort(403);
        }
        if (Auth::user()->role === 'ICT') {
            $pdf = \PDF::loadView('tasks.pdf_progress_ict', compact('task'));
        } else {
            $pdf = \PDF::loadView('tasks.pdf_progress_download', compact('task'));
        }
        $filename = 'Progress_' . str_replace(' ', '_', $task->nama) . '_' . $task->id . '.pdf';
        return $pdf->download($filename);
    }
} 