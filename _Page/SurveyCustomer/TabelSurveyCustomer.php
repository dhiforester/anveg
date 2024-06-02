<?php
    session_start();
    ini_set("display_errors","off");
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey WHERE id_akses='$SessionIdAkses'"));
?>
<?php
    $no = 1;
    $query = mysqli_query($Conn, "SELECT*FROM survey WHERE id_akses='$SessionIdAkses' ORDER BY id_survey ASC");
    while ($data = mysqli_fetch_array($query)) {
        $id_survey= $data['id_survey'];
        $id_akses= $data['id_akses'];
        $tanggal= $data['tanggal'];
        $judul= $data['judul'];
        //Format Tanggal
        $strtotime=strtotime($tanggal);
        $tanggal=date('d/m/Y',$strtotime);
        //Jumlah Klasifikasi
        $JumlahKlasifikasi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_klasifikasi WHERE id_survey='$id_survey'"));
        //File
        $JumlahRekap = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_rekap WHERE id_survey='$id_survey'"));
        //Bucket
        $JumlahRincian = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey_rincian WHERE id_survey='$id_survey'"));
?>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?Page=SurveyCustomer&Sub=DetailSurvey&id=<?php echo "$id_survey";?>">
                        <b><?php echo "$no. $judul";?></b>
                    </a>
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                            <li class="dropdown-header text-start">
                                <h6>Option</h6>
                            </li>
                            <li>
                                <a href="index.php?Page=SurveyCustomer&Sub=DetailSurvey&id=<?php echo "$id_survey";?>" class="dropdown-item" data-id="<?php echo "$id_survey"; ?>">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ModalEditSurvey" data-id="<?php echo "$id_survey"; ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalHapusSurvey" data-id="<?php echo "$id_survey"; ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
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
                                        Judul Survey : <code class="text-secondary"><?php echo "$judul"; ?></code>
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
<?php $no++; } ?>