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
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $ictUsers = User::where('role', 'ICT')->orderBy('name')->get();
        return view('tasks.create', compact('ictUsers'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tenggat_waktu' => 'required|date',
            'pic' => 'required|array|min:1',
            'pic.*' => 'required',
            'pic_other' => 'required_if:pic,other',
            'progress' => 'required|integer|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
        ]);
        $validated['created_by'] = Auth::id();
        $pic = $request->pic;
        if (in_array('other', $pic)) {
            $others = array_map('trim', explode(',', $request->pic_other));
            $pic = array_diff($pic, ['other']);
            $pic = array_merge($pic, $others);
        }
        $validated['pic'] = json_encode(array_values($pic));
        unset($validated['pic_other']);
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('tasks', 'public');
        }
        Task::create($validated);
        return redirect()->route('koor.progress')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    public function edit(Task $task)
    {
        if (Auth::user()->role === 'ICT') {
            $pics = $task->pic;
            if (is_string($pics)) {
                $pics = json_decode($pics, true);
            }
            if (!is_array($pics)) {
                $pics = [$pics];
            }
            if (!in_array(Auth::user()->name, array_map('trim', $pics))) {
                abort(403);
            }
        } else if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $ictUsers = User::where('role', 'ICT')->orderBy('name')->get();
        return view('tasks.edit', compact('task', 'ictUsers'));
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::user()->role === 'ICT') {
            $pics = $task->pic;
            if (is_string($pics)) {
                $pics = json_decode($pics, true);
            }
            if (!is_array($pics)) {
                $pics = [$pics];
            }
            if (!in_array(Auth::user()->name, array_map('trim', $pics))) {
                abort(403);
            }
            $validated = $request->validate([
                'progress' => 'required|integer|min:0|max:100',
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
            ]);
            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('tasks', 'public');
            }
            $task->update($validated);
            return redirect()->route('dashboard')->with('success', 'Progress berhasil diperbarui!');
        } else if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tenggat_waktu' => 'required|date',
            'pic' => 'required|array|min:1',
            'pic.*' => 'required',
            'pic_other' => 'required_if:pic,other',
            'progress' => 'required|integer|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
        ]);
        $pic = $request->pic;
        if (in_array('other', $pic)) {
            $others = array_map('trim', explode(',', $request->pic_other));
            $pic = array_diff($pic, ['other']);
            $pic = array_merge($pic, $others);
        }
        $validated['pic'] = json_encode(array_values($pic));
        unset($validated['pic_other']);
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('tasks', 'public');
        }
        $task->update($validated);
        return redirect()->route('koor.progress')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        
        if (Auth::user()->role !== 'koor') {
            abort(403);
        }
        $task->delete();
        return redirect()->route('koor.progress')->with('success', 'Pekerjaan berhasil dihapus!');
    }

    public function show(Task $task)
    {
        if (Auth::user()->role === 'ICT') {
            $pics = $task->pic;
            if (is_string($pics)) {
                $pics = json_decode($pics, true);
            }
            if (!is_array($pics)) {
                $pics = [$pics];
            }
            if (!in_array(Auth::user()->name, array_map('trim', $pics))) {
                abort(403);
            }
        } else if (Auth::user()->role !== 'koor') {
            abort(403);
        }
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
        
        if (Auth::user()->role === 'ICT' && !in_array(Auth::user()->name, array_map('trim', explode(',', $task->pic)))) {
            abort(403);
        }
        return view('tasks.pdf_progress', compact('task'));
    }

    public function downloadPdfProgress(Task $task)
    {

        if (!(Auth::user()->role === 'koor' || Auth::user()->role === 'ICT')) {
            abort(403);
        }
        if (Auth::user()->role === 'ICT') {
            $pdf = \PDF::loadView('tasks.pdf_progress_ict', compact('task'));
        } else {
            $pdf = \PDF::loadView('tasks.pdf_progress_download', compact('task'));
        }
        $filename = 'Progress_' . str_replace(' ', '', $task->nama) . '' . $task->id . '.pdf';
        return $pdf->download($filename);
    }
}