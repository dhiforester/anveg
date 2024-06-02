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
<div class="modal fade" id="ModalPilihApiKey" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark"><i class="bi bi-person-check"></i> Pilih Api Key</b>
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
<div class="modal fade" id="ModalTambahBucket" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahBucket">
                <div class="modal-header">
                    <b class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Bucket</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div id="FormTambahBucket"></div>
                    <div class="row">
                        <div class="col-md-12 mb-3" id="NotifikasiTambahBucket">
                            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
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
<div class="modal fade" id="ModalDetailBucket" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title text-dark">
                    <i class="bi bi-info-circle"></i> Detail Bucket
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="FormDetailBucket">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditBucket" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditBucket">
                <div class="modal-header">
                    <b class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Bucket</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormEditBucket"></div>
                    <div class="row">
                        <div class="col-md-12 mt-3" id="NotifikasiEditBucket">
                            <small class="text-primary">Pastikan data yang anda input sudah sesuai</small>
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
<div class="modal fade" id="ModalHapusBucket" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusBucket">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Bucket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_bucket" id="PutIdBucket">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="assets/img/question.gif" alt="" width="70%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusBucket">
                            <span class="text-primary">Apakah anda yakin akan menghapus data Bucket ini?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded" id="KonfirmasiHapusBucket">
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