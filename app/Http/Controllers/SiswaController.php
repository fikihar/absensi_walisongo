<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('siswa.dashboard');
    }

    // Absensi
    public function absensiIndex()
    {
        return view('siswa.absensi.index');
    }

    public function absensiStore(Request $request)
    {
        // Logic for storing absensi data
    }

    // Isi Form Absensi
    public function create()
    {
        return view('siswa.absensi.create');
    }
}
