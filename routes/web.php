<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::put('/profile/update', [App\Http\Controllers\AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

Route::get('/profile', [App\Http\Controllers\AuthController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [App\Http\Controllers\AuthController::class, 'editProfile'])->name('profile.edit')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/koor/barang', [BarangController::class, 'index'])->name('koor.barang.index');
    Route::get('/koor/barang/create', [BarangController::class, 'create'])->name('koor.barang.create');
    Route::post('/koor/barang', [BarangController::class, 'store'])->name('koor.barang.store');
    Route::delete('/koor/barang/{id}', [BarangController::class, 'destroy'])->name('koor.barang.destroy');
    
    Route::get('/koor/peminjaman-page', function () {
        return view('koor.peminjaman_page');
    })->name('koor.peminjaman.page');
    
    Route::get('/koor/peminjaman', [PeminjamanController::class, 'index'])->name('koor.peminjaman.index');
    Route::get('/koor/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('koor.peminjaman.show');
    Route::post('/koor/peminjaman/{id}/deadline', [PeminjamanController::class, 'setDeadline'])->name('koor.peminjaman.setDeadline');
    Route::post('/koor/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('koor.peminjaman.approve');
    Route::post('/koor/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('koor.peminjaman.reject');
    Route::get('/koor/peminjaman/{id}/download-pdf', [PeminjamanController::class, 'downloadPDF'])->name('koor.peminjaman.downloadPDF');
    Route::get('/koor/peminjaman-telat', [PeminjamanController::class, 'notifikasiTelat'])->name('koor.peminjaman.telat');
    Route::delete('/koor/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('koor.peminjaman.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/general/peminjaman/create', [PeminjamanController::class, 'create'])->name('general.peminjaman.create');
    Route::post('/general/peminjaman', [PeminjamanController::class, 'store'])->name('general.peminjaman.store');
    Route::get('/general/peminjaman/history', [PeminjamanController::class, 'history'])->name('general.peminjaman.history');
    Route::put('/general/peminjaman/{id}/return', [PeminjamanController::class, 'return'])->name('general.peminjaman.return');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ict/peminjaman', [PeminjamanController::class, 'listICT'])->name('ict.peminjaman.list');
    Route::get('/ict/progress', [DashboardController::class, 'progressICT'])->name('ict.progress');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
    Route::get('/koor/progress', [TaskController::class, 'progressKoor'])->name('koor.progress');
    Route::get('/tasks/{task}/pdf-progress', [TaskController::class, 'pdfProgress'])->name('tasks.pdf_progress');
    Route::get('/tasks/{task}/download-pdf-progress', [TaskController::class, 'downloadPdfProgress'])->name('tasks.download_pdf_progress');
});
