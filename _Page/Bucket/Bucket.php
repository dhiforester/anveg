<section class="section dashboard">
    <div class="row">
        <div class="col-lg-3">
            <form action="javascript:void(0);" id="ProsesBatas">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-search"></i> Cari & Filter</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="page" id="PutPage" value="">
                        <div class="row">
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
                                <small>Batas Data</small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <select name="OrderBy" id="OrderBy" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="id_akses">ID Akses</option>
                                    <option value="id_api_key">ID Api Key</option>
                                    <option value="nama">Nama</option>
                                    <option value="deskripsi">Deskripsi</option>
                                    <option value="maksimal">Maksimal</option>
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
                                    <option value="id_akses">ID Akses</option>
                                    <option value="id_api_key">ID Api Key</option>
                                    <option value="nama">Nama</option>
                                    <option value="deskripsi">Deskripsi</option>
                                    <option value="maksimal">Maksimal</option>
                                </select>
                                <small>Keyword By</small>
                            </div>
                            <div class="col-md-12 mb-3" id="FormKeyword">
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">
                                <small>Keyword</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class="btn btn-md btn-rounded btn-dark btn-block">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                            <div class="col-md-12 text-center mb-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihAkses" title="Tambah Api Key">
                                    <i class="bi bi-plus"></i> Tambah Bucket
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <div id="MenampilkanTabelBucket"></div>
        </div>
    </div>
</section>