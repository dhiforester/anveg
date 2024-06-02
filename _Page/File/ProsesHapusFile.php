<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small><code class="text-danger">Silahkan reload halaman dan login terlebih dulu</code></small>';
    }else{
        if(empty($_POST['id_file_list'])){
            echo '<small><code class="text-danger">ID File List Tidak Boleh Kosong</code></small>';
        }else{
            $id_file_list=$_POST['id_file_list'];
            //Buka Nama File
            $nama=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'nama');
            //Tempat Penyimpanan
            $tempat="../../storage/$nama";
            //Hapus File
            $HapusFile = mysqli_query($Conn, "DELETE FROM file_list WHERE id_file_list='$id_file_list'") or die(mysqli_error($Conn));
            if ($HapusFile) {
                //Hapus File
                unlink($tempat);
                //Simpan Log
                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Hapus File");
                if($SimpanLog=="Success"){
                    //Tampilkan Swal
                    echo '<span class="text-success" id="NotifikasiHapusFileBerhasil">Success</span>';
                }else{
                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                }
            }else{
                echo '<span class="text-danger">Hapus Data Gagal</span>';
            }
        }
    }
?>