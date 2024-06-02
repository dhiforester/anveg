<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman laporan.';
                echo '  Anda bisa melakukan pencetakan data laporan sesuai format yang diinginkan.';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesLaporan">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <input type="date" name="periode_awal" id="periode_awal" class="form-control">
                                <small>Periode Awal</small>
                            </div>
                            <div class="col-md-4 mt-3">
                                <input type="date" name="periode_akhir" id="periode_akhir" class="form-control">
                                <small>Periode Akhir</small>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded">
                                    <i class="bi bi-search"></i> Tampilkan
                                </button>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-success btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalCetakLaporan">
                                    <i class="bi bi-printer"></i> Cetak
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" id="MenampilkanTabelLaporan">
                    <div class="row">
                        <div class="col-md-12 text-center text-danger">
                            <small>Silahkan isi periode laporan yang ingin ditampilkan!</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>