 {{-- Modal Tambah Siswa --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.siswa.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Email (digunakan untuk login)</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telp" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password Default</label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="form-text text-muted">Password awal bisa diganti oleh siswa nanti.</small>
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
