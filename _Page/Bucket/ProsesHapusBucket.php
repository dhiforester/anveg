<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST['id_bucket'])){
            echo '<span class="text-danger">ID Bucket tidak dapat ditangkap oleh sistem</span>';
        }else{
            $id_bucket=$_POST['id_bucket'];
            //Hitung Jumlah File
            $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'"));
            //Arraykan File
            if(!empty($JumlahFile)){
                $Qry = mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'");
                while ($Data = mysqli_fetch_array($Qry)) {
                    $id_file_list= $Data['id_file_list'];
                    $nama= $Data['nama'];
                    $FotoLama = "../../storage/".$nama;
                    unlink($FotoLama);
                    $HapusFile = mysqli_query($Conn, "DELETE FROM file_list WHERE id_file_list='$id_file_list'") or die(mysqli_error($Conn));
                }
            }
            //Hapus Bucket
            $HapusBucket = mysqli_query($Conn, "DELETE FROM bucket WHERE id_bucket='$id_bucket'") or die(mysqli_error($Conn));
            if ($HapusBucket) {
                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Bucket","Hapus Bucket");
                if($SimpanLog=="Success"){
                    echo '<span class="text-success" id="NotifikasiHapusBucketBerhasil">Success</span>';
                }else{
                    echo '<small class="text-danger">'.$SimpanLog.'</small>';
                }
            }else{
                echo '<span class="text-danger">Hapus Data Gagal</span>';
            }
        }
    }
?>