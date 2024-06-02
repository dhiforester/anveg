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
                        if(empty($_POST['id_file_referensi'])){
                            echo '<small><code class="text-danger">ID Referensi File Tidak Boleh Kosong!</code></small>';
                        }else{
                            $id_file_referensi=$_POST['id_file_referensi'];
                            $tipe_file=$_POST['tipe_file'];
                            $extensi_file=$_POST['extensi_file'];
                            $support_file=$_POST['support_file'];
                            $maksimum_upload=$_POST['maksimum_upload'];
                            //Buka Data Lama
                            $TipeFileLama=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'tipe_file');
                            $ExtensiFileLama=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'extensi_file');
                            //Validasi Tipe File Sama
                            if($TipeFileLama==$tipe_file){
                                $ValidasiTipeFileSama=0;
                            }else{
                                $ValidasiTipeFileSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_referensi WHERE tipe_file='$tipe_file'"));
                            }
                            //Validasi Extensi File Sama
                            if($ExtensiFileLama==$extensi_file){
                                $ValidasiExtensionFileSama=0;
                            }else{
                                $ValidasiExtensionFileSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_referensi WHERE extensi_file='$extensi_file'"));
                            }
                            if(!empty($ValidasiTipeFileSama)){
                                echo '<small><code class="text-danger">Tipe File Tersebut Sudah Ada</code></small>';
                            }else{
                                if(!empty($ValidasiExtensionFileSama)){
                                    echo '<small><code class="text-danger">Extension File Tersebut Sudah Ada</code></small>';
                                }else{
                                    $UpdateReferensiFile = mysqli_query($Conn,"UPDATE file_referensi SET 
                                        support_file='$support_file',
                                        tipe_file='$tipe_file',
                                        extensi_file='$extensi_file',
                                        maksimum_upload='$maksimum_upload'
                                    WHERE id_file_referensi='$id_file_referensi'") or die(mysqli_error($Conn)); 
                                    if($UpdateReferensiFile){
                                        $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Edit Referensi File");
                                        if($SimpanLog=="Success"){
                                            echo '<small class="text-success" id="NotifikasiEditReferensiFileBerhasil">Success</small>';
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
        }
    }
?>