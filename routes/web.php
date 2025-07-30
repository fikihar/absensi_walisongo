<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Redirect users based on their role after login
Route::middleware(['auth'])->get('/home', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->hasRole('guru')) {
        return redirect()->route('guru.dashboard');
    } elseif (Auth::user()->hasRole('siswa')) {
        return redirect()->route('siswa.dashboard');
    }

    // Default to the home view if the user role doesn't match
    return view('home');
});

// --- ADMIN ---
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen Siswa
    Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa.index');
    Route::post('/siswa', [AdminController::class, 'siswaStore'])->name('siswa.store');
    Route::put('/siswa/{id}', [AdminController::class, 'siswaUpdate'])->name('siswa.update');
    Route::delete('/siswa/{id}', [AdminController::class, 'siswaDestroy'])->name('siswa.destroy');

    // Manajemen Guru
    Route::get('/guru', [AdminController::class, 'guruIndex'])->name('guru.index');
    Route::post('/guru', [AdminController::class, 'guruStore'])->name('guru.store');
    Route::put('/guru/{id}', [AdminController::class, 'guruUpdate'])->name('guru.update');
    Route::delete('/guru/{id}', [AdminController::class, 'guruDestroy'])->name('guru.destroy');

    // Manajemen DUDI
    Route::get('/dudi', [AdminController::class, 'dudiIndex'])->name('dudi.index');
    Route::post('/dudi', [AdminController::class, 'dudiStore'])->name('dudi.store');
    Route::put('/dudi/{id}', [AdminController::class, 'dudiUpdate'])->name('dudi.update');
    Route::delete('/dudi/{id}', [AdminController::class, 'dudiDestroy'])->name('dudi.destroy');

    // Alokasi Siswa ke DUDI
    Route::get('/alokasi-siswa', [AdminController::class, 'alokasiSiswaIndex'])->name('alokasi-siswa.index');
    Route::post('/alokasi-siswa', [AdminController::class, 'alokasiSiswaStore'])->name('alokasi-siswa.store');
    Route::delete('/alokasi-siswa/{id}', [AdminController::class, 'alokasiSiswaDestroy'])->name('alokasi-siswa.destroy');

    // Alokasi Guru ke DUDI
    Route::get('/alokasi-guru', [AdminController::class, 'alokasiGuruIndex'])->name('alokasi-guru.index');
    Route::post('/alokasi-guru', [AdminController::class, 'alokasiGuruStore'])->name('alokasi-guru.store');
    Route::delete('/alokasi-guru/{id}', [AdminController::class, 'alokasiGuruDestroy'])->name('alokasi-guru.destroy');

    // Laporan Absensi
    Route::get('/laporan-absensi', [AdminController::class, 'laporanAbsensi'])->name('laporan-absensi.index');
    Route::get('/laporan-absensi/export-pdf', [AdminController::class, 'exportAbsensiPdf'])->name('laporan-absensi.export');
});

// --- GURU ---
Route::prefix('admin-guru')->name('guru.')->middleware('role:guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');

    // Absensi
    Route::get('/absensi', [GuruController::class, 'absensiIndex'])->name('absensi.index');

    // Daftar Siswa
    Route::get('/siswa', [GuruController::class, 'siswaIndex'])->name('siswa.index');

    // Laporan Absensi
    Route::get('/laporan-absensi', [GuruController::class, 'laporanAbsensi'])->name('laporan-absensi.index');
    Route::get('/laporan-absensi/export-pdf', [GuruController::class, 'exportAbsensiPdf'])->name('laporan-absensi.export');
});

// --- SISWA ---
Route::prefix('siswa')->name('siswa.')->middleware('role:siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('dashboard');

    // Absensi
    Route::get('/absensi', [SiswaController::class, 'absensiIndex'])->name('absensi.index');
    Route::post('/absensi', [SiswaController::class, 'absensiStore'])->name('absensi.store');

    // Isi Form Absensi
    Route::get('/absensi/create', [SiswaController::class, 'create'])->name('absensi.create');
});
