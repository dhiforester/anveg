<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small><code class="text-danger">Silahkan reload halaman dan login terlebih dulu</code></small>';
    }else{
        if(empty($_POST['tipe_file'])){
            echo '<small><code class="text-danger">Tipe File Tidak Boleh Kosong!</code></small>';
        }else{
            if(empty($_POST['extensi_file'])){
                echo '<small><code class="text-danger">Extensi File Tidak Boleh Kosong!</code></small>';
            }else{
                if(empty($_POST['support_file'])){
                    echo '<small><code class="text-danger">Dupport File Tidak Boleh Kosong!</code></small>';
                }else{
                    if(empty($_POST['maksimum_upload'])){
                        echo '<small><code class="text-danger">Maksimum Ukuran File Tidak Boleh Kosong!</code></small>';
                    }else{
                        $tipe_file=$_POST['tipe_file'];
                        $extensi_file=$_POST['extensi_file'];
                        $support_file=$_POST['support_file'];
                        $maksimum_upload=$_POST['maksimum_upload'];
                        //Validasi Duplikat
                        $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_referensi WHERE tipe_file='$tipe_file' OR extensi_file='$extensi_file'"));
                        if(!empty($ValidasiDuplikat)){
                            echo '<small><code class="text-danger">Data Tersebut Sudah Ada</code></small>';
                        }else{
                            $entry="INSERT INTO file_referensi (
                                support_file,
                                tipe_file,
                                extensi_file,
                                maksimum_upload
                            ) VALUES (
                                '$support_file',
                                '$tipe_file',
                                '$extensi_file',
                                '$maksimum_upload'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Tambah Referensi File");
                                if($SimpanLog=="Success"){
                                    echo '<small class="text-success" id="NotifikasiTambahReferensiFileBerhasil">Success</small>';
                                }else{
                                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                                }
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>