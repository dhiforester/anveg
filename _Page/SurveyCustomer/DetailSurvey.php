<?php
    if(empty($_GET['id'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-center text-danger">';
        echo '              ID Tidak Boleh Kosong!';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_survey=$_GET['id'];
        $JudulSurvey=getDataDetail($Conn,'survey','id_survey',$id_survey,'judul');
        $tanggal=getDataDetail($Conn,'survey','id_survey',$id_survey,'tanggal');
        //Jumlah Klasifikasi
        $JumlahKlasifikasi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_klasifikasi WHERE id_survey='$id_survey'"));
        //File
        $JumlahRekap = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_rekap WHERE id_survey='$id_survey'"));
        //Bucket
        $JumlahRincian = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_rincian WHERE id_survey='$id_survey'"));
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Detail Informasi Survey</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <small>
                                            ID Survey : <code class="text-secondary"><?php echo "$id_survey"; ?></code>
                                        </small>
                                    </li>
                                    <li>
                                        <small>
                                            Tanggal : <code class="text-secondary"><?php echo "$tanggal"; ?></code>
                                        </small>
                                    </li>
                                    <li>
                                        <small>
                                            Judul Survey : <code class="text-secondary"><?php echo "$JudulSurvey"; ?></code>
                                        </small>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <small>
                                            Klasifikasi : <code class="text-secondary"><?php echo "$JumlahKlasifikasi Record"; ?></code>
                                        </small>
                                    </li>
                                    <li>
                                        <small>
                                            Rekap : <code class="text-secondary"><?php echo "$JumlahRekap Record"; ?></code>
                                        </small>
                                    </li>
                                    <li>
                                        <small>
                                            Rincian : <code class="text-secondary"><?php echo "$JumlahRincian Record"; ?></code>
                                        </small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <b class="card-title">Klasifikasi Survey</b>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-block btn-primary btn-rounded">
                                    <i class="bi bi-plus"></i> Tambah Klasifikasi
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table table-responsive">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    }
?>