@extends('layouts.app', ['title' => 'Dashboard'])

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Siswa</h1>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">&times;</button>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Siswa</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                Tambah Siswa
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_siswa as $index => $siswa)
                                    <tr>
                                        <td>{{ ($data_siswa->currentPage() - 1) * $data_siswa->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->kelas }}</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        <td>{{ $siswa->no_telp }}</td>
                                        <td>{{ optional($siswa->user)->email }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modalEdit{{ $siswa->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus siswa ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-3">
                            {{ $data_siswa->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Tambah --}}
    @include('admin.partials.tambah_siswa')

    {{-- Modal Edit untuk setiap siswa --}}
    @foreach ($data_siswa as $siswa)
        @include('admin.partials.edit_siswa', ['siswa' => $siswa])
    @endforeach
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
