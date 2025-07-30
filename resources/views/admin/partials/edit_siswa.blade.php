<div class="modal fade" id="modalEdit{{ $siswa->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $siswa->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel{{ $siswa->id }}">Edit Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if ($errors->any() && session('last_id') == $siswa->id)
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nis{{ $siswa->id }}">NIS</label>
                        <input type="text" name="nis" id="nis{{ $siswa->id }}" class="form-control"
                            value="{{ old('nis', $siswa->nis) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama{{ $siswa->id }}">Nama</label>
                        <input type="text" name="nama" id="nama{{ $siswa->id }}" class="form-control"
                            value="{{ old('nama', $siswa->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kelas{{ $siswa->id }}">Kelas</label>
                        <input type="text" name="kelas" id="kelas{{ $siswa->id }}" class="form-control"
                            value="{{ old('kelas', $siswa->kelas) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin{{ $siswa->id }}">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin{{ $siswa->id }}" class="form-control"
                            required>
                            <option value="">-- Pilih --</option>
                            <option value="laki-laki"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="perempuan"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="no_telp{{ $siswa->id }}">No Telepon</label>
                        <input type="text" name="no_telp" id="no_telp{{ $siswa->id }}" class="form-control"
                            value="{{ old('no_telp', $siswa->no_telp) }}">
                    </div>

                    <div class="form-group">
                        <label>Email (tidak bisa diubah)</label>
                        <input type="email" class="form-control" value="{{ optional($siswa->user)->email }}"
                            readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
