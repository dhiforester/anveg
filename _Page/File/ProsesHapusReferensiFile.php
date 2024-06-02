<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small><code class="text-danger">Silahkan reload halaman dan login terlebih dulu</code></small>';
    }else{
        if(empty($_POST['id_file_referensi'])){
            echo '<small><code class="text-danger">ID Referensi File Tidak Boleh Kosong</code></small>';
        }else{
            $id_file_referensi=$_POST['id_file_referensi'];
            //Hapus Referensi File
            $HapusReferensiFile = mysqli_query($Conn, "DELETE FROM file_referensi WHERE id_file_referensi='$id_file_referensi'") or die(mysqli_error($Conn));
            if ($HapusReferensiFile) {
                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Hapus Referensi File");
                if($SimpanLog=="Success"){
                    echo '<span class="text-success" id="NotifikasiHapusReferensiFileBerhasil">Success</span>';
                }else{
                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                }
            }else{
                echo '<span class="text-danger">Hapus Data Gagal</span>';
            }
        }
    }
?>