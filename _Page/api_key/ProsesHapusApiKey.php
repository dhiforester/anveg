<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST['id_api_key'])){
            echo '<span class="text-danger">ID Api Key tidak dapat ditangkap oleh sistem</span>';
        }else{
            $id_api_key=$_POST['id_api_key'];
            //Hapus Data yang Berkaitan Dengan ID Api Key Ini
            $HapusLog = mysqli_query($Conn, "DELETE FROM log WHERE id_api_key='$id_api_key'") or die(mysqli_error($Conn));
            $HapusBucket = mysqli_query($Conn, "DELETE FROM bucket WHERE id_api_key='$id_api_key'") or die(mysqli_error($Conn));
            $HapusApiKey = mysqli_query($Conn, "DELETE FROM api_key WHERE id_api_key='$id_api_key'") or die(mysqli_error($Conn));
            if ($HapusApiKey) {
                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Api Key","Hapus Api Key");
                if($SimpanLog=="Success"){
                    echo '<span class="text-success" id="NotifikasiHapusApiKeyBerhasil">Success</span>';
                }else{
                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                }
            }else{
                echo '<span class="text-danger">Hapus Data Gagal</span>';
            }
        }
    }
?>