<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">
                        <i class="bi bi-bar-chart-line"></i> Grafik Log Aktivitas
                    </b>
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                            <li class="dropdown-header text-start">
                                <h6>Mode Grafik</h6>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" id="TahunIni">
                                    Tahun Ini
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" id="BulanIni">
                                    Bulan Ini
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" id="HariIni">
                                    Hari Ini
                                </a> 
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="MenampilkanGrafikLog">

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Mode Grafik : <span id="ModeGrafik" class="text-dark">Tahun ini</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="javascript:void(0);" id="ProsesBatas">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title"><i class="bi bi-search"></i> Cari & Filter</b>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="page" id="PutPage" value="">
                        <div class="row">
                            <div class="col-md-1 mb-3">
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
                            <div class="col-md-2 mb-3">
                                <select name="OrderBy" id="OrderBy" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="id_akses">ID Akses</option>
                                    <option value="id_api_key">ID Api Key</option>
                                    <option value="tanggal">Tanggal</option>
                                    <option value="kategori">Kategori</option>
                                    <option value="deskripsi">Deskripsi</option>
                                </select>
                                <small>Order By</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select name="ShortBy" id="ShortBy" class="form-control">
                                    <option value="DESC">Z to A</option>
                                    <option value="ASC">A to Z</option>
                                </select>
                                <small>Short By</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select name="keyword_by" id="keyword_by" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="id_akses">ID Akses</option>
                                    <option value="id_api_key">ID Api Key</option>
                                    <option value="tanggal">Tanggal</option>
                                    <option value="kategori">Kategori</option>
                                    <option value="deskripsi">Deskripsi</option>
                                </select>
                                <small>Keyword By</small>
                            </div>
                            <div class="col-md-3 mb-3" id="FormKeyword">
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">
                                <small>Keyword</small>
                            </div>
                            <div class="col-md-2 mb-3" id="FormKeyword">
                                <button type="submit" class="btn btn-md btn-rounded btn-dark btn-block">
                                    <i class="bi bi-search"></i> Cari & Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">
                        <i class="bi bi-table"></i> Data Log
                    </b>
                </div>
                <div id="MenampilkanTabelLog">

                </div>
            </div>
        </div>
    </div>
</section>