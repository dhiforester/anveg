<!-- Modal Tambah Referensi File -->
<div class="modal fade" id="ModalTambahReferensiFile" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahReferensiFile">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Referensi File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="support_file"><b>Support File</b></label>
                            <select name="support_file" id="support_file" class="form-control">
                                <option value="">Pilih</option>
                                <option value="vidio">Vidio</option>
                                <option value="audio">Audio</option>
                                <option value="image">Image</option>
                                <option value="document">Document</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="tipe_file"><b>Tipe File</b></label>
                            <input type="text" name="tipe_file" id="tipe_file" class="form-control" placeholder="ex: image/jpg">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="extensi_file"><b>Extensi File</b></label>
                            <input type="text" name="extensi_file" id="extensi_file" class="form-control" placeholder="ex: .jpg">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="maksimum_upload"><b>Maksimum Per Upload</b></label>
                            <select name="maksimum_upload" id="maksimum_upload" class="form-control">
                                <option value="">Pilih</option>
                                <option value="1000000">1 Mb</option>
                                <option value="2000000">2 Mb</option>
                                <option value="5000000">5 Mb</option>
                                <option value="10000000">10 Mb</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-left" id="NotifikasiTambahReferensiFile">
                            <small><code class="text-primary">Pastikan Pengaturan Referensi Sudah Sesuai</code></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Referensi File -->
<div class="modal fade" id="ModalEditReferensiFile" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditReferensiFile">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Referensi File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3" id="FormEditReferensiFile">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-left" id="NotifikasiEditReferensiFile">
                            <small><code class="text-primary">Pastikan Pengaturan Referensi Sudah Sesuai</code></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Referensi File -->
<div class="modal fade" id="ModalHapusReferensiFile" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusReferensiFile">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Referensi File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_file_referensi" id="PutIdFileReferensi">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="assets/img/question.gif" alt="" width="70%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusReferensiFile">
                            <small><code class="text-primary">Apakah anda yakin akan menghapus data ini?</code></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Pilih Akses -->
<div class="modal fade" id="ModalPilihAkses" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark"><i class="bi bi-person-check"></i> Pilih Akun User</b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <form action="javascript:void(0);" id="ProsesCariAkses" class="mb-3">
                    <div class="row border-1 border-bottom">
                        <div class="col-md-12 mb-3">
                            <div class="input-group">
                                <input type="text" name="KeywordAkses" class="form-control">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="MenampilkanTabelAkses">
                    <!-- Menampilkan Tabel Akses Yang Dipilih -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pilih Api Key -->
<div class="modal fade" id="ModalPilihApiKey" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark"><i class="bi bi-key"></i> Pilih Api Key</b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div id="MenampilkanListApiKey">
                    <!-- Menampilkan List Api Key -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihAkses">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </button>
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pilih Bucket -->
<div class="modal fade" id="ModalPilihBucket" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark"><i class="bi bi-person-check"></i> Pilih Bucket</b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="MenampilkanListBucket">
                <!-- Menampilkan List Bucket -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah File -->
<div class="modal fade" id="ModalTambahFile" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahFile">
                <div class="modal-header">
                    <b class="modal-title text-dark"><i class="bi bi-upload"></i> Tambah File</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div id="FormTambahFile"></div>
                    <div class="row">
                        <div class="col-md-12 mb-3" id="NotifikasiTambahFile">
                            <small><code class="text-primary">Pastkan data yang anda input sudah benar</code></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-upload"></i> Upload File
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalDetailFile" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark">
                    <i class="bi bi-info-circle"></i> Detail File
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="FormDetailFile">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditFile" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditFile">
                <div class="modal-header">
                    <b class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit File</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormEditFile">
                        <!-- Form Edit File -->
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3" id="NotifikasiEditFile">
                            <small><code class="text-primary">Pastikan data yang anda input sudah sesuai</code></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusFile" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusFile">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_file_list" id="PutIdFile">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="assets/img/question.gif" alt="" width="70%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusFile">
                            <small>
                                <code class="text-primary">Apakah anda yakin akan menghapus data File ini?</code>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded" id="KonfirmasiHapusFile">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>