<section class="section dashboard">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Referensi Tipe File
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <button type="button" class="btn btn-md btn-rounded btn-info btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahReferensiFile">
                                                <i class="bi bi-plus"></i> Tambah Referensi
                                            </button>
                                        </div>
                                    </div>
                                    <div id="MenampilkanTabelReferensiFile">
                                        <!-- Menampilkan Referensi File -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Filter & Pencarian
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="javascript:void(0);" id="ProsesBatas">
                                        <input type="hidden" name="page" id="PutPage" value="">
                                        <div class="row mt-3">
                                            <div class="col-md-12 mb-3">
                                                <select name="batas" id="batas" class="form-control">
                                                    <option value="5">5</option>
                                                    <option selected value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="250">250</option>
                                                    <option value="500">500</option>
                                                </select>
                                                <small>Batas</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <select name="OrderBy" id="OrderBy" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="id_akses">Akses</option>
                                                    <option value="id_api_key">Api Key</option>
                                                    <option value="id_bucket">Bucket</option>
                                                    <option value="nama">Nama</option>
                                                    <option value="label">Label</option>
                                                    <option value="kategori">Kategori</option>
                                                    <option value="tipe_file">Tipe</option>
                                                    <option value="ukuran">Ukuran</option>
                                                </select>
                                                <small>Order By</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <select name="ShortBy" id="ShortBy" class="form-control">
                                                    <option value="DESC">Z to A</option>
                                                    <option value="ASC">A to Z</option>
                                                </select>
                                                <small>Short By</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <select name="keyword_by" id="keyword_by" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="id_akses">Akses</option>
                                                    <option value="id_api_key">Api Key</option>
                                                    <option value="id_bucket">Bucket</option>
                                                    <option value="nama">Nama</option>
                                                    <option value="label">Label</option>
                                                    <option value="kategori">Kategori</option>
                                                    <option value="tipe_file">Tipe</option>
                                                    <option value="ukuran">Ukuran</option>
                                                </select>
                                                <small>Keyword By</small>
                                            </div>
                                            <div class="col-md-12 mb-3" id="FormKeyword">
                                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">
                                                <small>Keyword</small>
                                            </div>
                                            <div class="col-md-12 text-center mb-3">
                                                <button type="submit" class="btn btn-md btn-rounded btn-dark btn-block">
                                                    <i class="bi bi-search"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Upload File
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <ol>
                                                <li>
                                                    <small>Memilih <b>ID Akses</b> sebagai identifikasi kepemilikan.</small>
                                                </li>
                                                <li>
                                                    <small>Memilih <b>ID API Key</b> untuk mengetahui file dapat dipanggil menggunakan API key yang mana.</small>
                                                </li>
                                                <li>
                                                    <small>Memilih <b>ID Bucket</b> untuk grouping penyimpanan file.</small>
                                                </li>
                                                <li>
                                                    <small>Pastikan tipe file yang diupload sesuai dengan referensi.</small>
                                                </li>
                                                <li>
                                                    <small>Ukuran file maksimum sesuai dengan referensi.</small>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihAkses" title="Tambah File">
                                                <i class="bi bi-plus"></i> Upload File
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Batas -->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div id="MenampilkanTabelFile"></div>
        </div>
    </div>
</section>