<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Guru;
use App\Models\Absensi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        // Mengambil jumlah siswa, dudi, guru, dan absensi
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalDudi = Dudi::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalAbsensi = Absensi::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalDudi', 'totalGuru', 'totalAbsensi'));
    }

    // Manajemen Siswa
    public function siswaIndex()
    {
        $siswas = Siswa::all();
        $users = User::where('role', 'siswa')->get();
        $data_siswa = Siswa::with('user')->get();

     return view('admin.data_siswa', compact('siswas', 'users', 'data_siswa'));
    }

    public function siswaStore(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'nis' => 'required|string|unique:siswa,nis',
                'kelas' => 'required|string',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'no_telp' => 'nullable|string',
            ]);

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password), // atau ganti ke 'password123'
                'role' => 'siswa',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menambahkan siswa: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function siswaUpdate(Request $request, $id)
    {
         dd($request->all());
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis,' . $siswa->id,
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_telp' => 'nullable|string',
        ]);

        // Update nama di tabel users
        if ($user) {
            $user->update([
                'name' => $validated['nama'],
            ]);
        }

        // Update data siswa
        $siswa->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Data siswa berhasil diperbarui.')
            ->with('last_id', $siswa->id);
    }

    public function siswaDestroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        if ($siswa->user) {
            $siswa->user->delete();
        }
        $siswa->forceDelete();
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus permanen.');
    }


    // Manajemen Guru
    public function guruIndex()
    {
        $guru = Guru::all();
        return view('admin.guru.index', compact('guru'));
    }

    public function guruStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:guru',
            'email' => 'nullable|email|unique:guru',
            'no_telp' => 'nullable|string'
        ]);

        Guru::create($validated);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function guruUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:guru,nip,' . $id,
            'email' => 'nullable|email|unique:guru,email,' . $id,
            'no_telp' => 'nullable|string'
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($validated);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function guruDestroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    // Manajemen DUDI
    public function dudiIndex()
    {
        $dudi = Dudi::all();
        return view('admin.dudi.index', compact('dudi'));
    }

    public function dudiStore(Request $request)
    {
        $validated = $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string'
        ]);

        Dudi::create($validated);
        return redirect()->route('admin.dudi.index')->with('success', 'Data Dudi berhasil ditambahkan.');
    }

    public function dudiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string'
        ]);

        $dudi = Dudi::findOrFail($id);
        $dudi->update($validated);
        return redirect()->route('admin.dudi.index')->with('success', 'Data Dudi berhasil diperbarui.');
    }

    public function dudiDestroy($id)
    {
        $dudi = Dudi::findOrFail($id);
        $dudi->delete();
        return redirect()->route('admin.dudi.index')->with('success', 'Data Dudi berhasil dihapus.');
    }

    // Alokasi Siswa ke DUDI
    public function alokasiSiswaIndex()
    {
        $siswa = Siswa::all();
        $dudi = Dudi::all();
        return view('admin.alokasi-siswa.index', compact('siswa', 'dudi'));
    }

    public function alokasiSiswaStore(Request $request)
    {
        // Logika untuk alokasi siswa ke DUDI
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'dudi_id' => 'required|exists:dudi,id',
        ]);

        // Misalnya menyimpan ke tabel pivot atau model alokasi
        // Penyesuaian sesuai kebutuhan aplikasi Anda

        return redirect()->route('admin.alokasi-siswa.index')->with('success', 'Siswa berhasil dialokasikan.');
    }

    public function alokasiSiswaDestroy($id)
    {
        // Hapus alokasi siswa
        return redirect()->route('admin.alokasi-siswa.index')->with('success', 'Alokasi siswa berhasil dihapus.');
    }

    // Alokasi Guru ke DUDI
    public function alokasiGuruIndex()
    {
        $guru = Guru::all();
        $dudi = Dudi::all();
        return view('admin.alokasi-guru.index', compact('guru', 'dudi'));
    }

    public function alokasiGuruStore(Request $request)
    {
        // Logika untuk alokasi guru ke DUDI
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'dudi_id' => 'required|exists:dudi,id',
        ]);

        // Misalnya menyimpan ke tabel pivot atau model alokasi
        // Penyesuaian sesuai kebutuhan aplikasi Anda

        return redirect()->route('admin.alokasi-guru.index')->with('success', 'Guru berhasil dialokasikan.');
    }

    public function alokasiGuruDestroy($id)
    {
        // Hapus alokasi guru
        return redirect()->route('admin.alokasi-guru.index')->with('success', 'Alokasi guru berhasil dihapus.');
    }

    // Laporan Absensi
    public function laporanAbsensi()
    {
        $absensi = Absensi::all();
        return view('admin.laporan-absensi.index', compact('absensi'));
    }

    public function exportAbsensiPdf()
    {
        $absensi = Absensi::all(); // Mengambil data absensi
        $pdf = Pdf::loadView('admin.laporan-absensi.pdf', compact('absensi'));
        return $pdf->download('laporan-absensi.pdf'); // Mengunduh file PDF
    }
}
