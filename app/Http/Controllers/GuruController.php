<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('guru.dashboard');
    }

    // Absensi
    public function absensiIndex()
    {
        return view('guru.absensi.index');
    }

    // Daftar Siswa
    public function siswaIndex()
    {
        return view('guru.siswa.index');
    }

    // Laporan Absensi
    public function laporanAbsensi()
    {
        return view('guru.laporan-absensi.index');
    }

    public function exportAbsensiPdf()
    {
        // Logic to export absensi report as PDF
    }
}
