<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST['id_akses'])){
            echo '<span class="text-danger">ID Akses tidak dapat ditangkap oleh sistem</span>';
        }else{
            $id_akses=$_POST['id_akses'];
            //Hapus Data yang Berkaitan Dengan ID Akses Ini
            $HapusLog = mysqli_query($Conn, "DELETE FROM log WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            $HapusApiKey = mysqli_query($Conn, "DELETE FROM api_key WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            $HapusBucket = mysqli_query($Conn, "DELETE FROM bucket WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            //Buka Akses
            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
            //Proses hapus data
            $HapusAkses = mysqli_query($Conn, "DELETE FROM akses WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            if ($HapusAkses) {
                if(!empty($DataDetailAkses['foto'])){
                    $gambar=$DataDetailAkses['foto'];
                    $FotoLama = "../../assets/img/User/".$gambar;
                    unlink($FotoLama);
                }
                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Akses","Hapus Akses");
                if($SimpanLog=="Success"){
                    echo '<span class="text-success" id="NotifikasiHapusAksesBerhasil">Success</span>';
                }else{
                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                }
                
            }else{
                echo '<span class="text-danger">Hapus Data Gagal</span>';
            }
        }
    }
?>