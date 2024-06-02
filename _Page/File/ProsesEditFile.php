<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:i:s');
    if(empty($_SESSION["id_akses"])){
        echo '<small><code class="text-danger">Silahkan reload halaman dan login terlebih dulu</code></small>';
    }else{
        if(empty($_POST['id_file_list'])){
            echo '<small><code class="text-danger">ID File Tidak Boleh Kosong!</code></small>';
        }else{
            if(empty($_POST['label_file'])){
                echo '<small><code class="text-danger">Label File Tidak Boleh Kosong!</code></small>';
            }else{
                if(empty($_POST['kategori'])){
                    echo '<small><code class="text-danger">Kategori Tidak Boleh Kosong!</code></small>';
                }else{
                    $id_file_list=$_POST['id_file_list'];
                    $label_file=$_POST['label_file'];
                    $kategori=$_POST['kategori'];
                    //Membuka File Lama
                    $LabelFileLama=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'label');
                    if($LabelFileLama==$label_file){
                        $ValidasiLabelSama=0;
                    }else{
                        $ValidasiLabelSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE label='$label_file'"));
                    }
                    //Validasi Duplikat
                    if(!empty($ValidasiLabelSama)){
                        echo '<small><code class="text-danger">Label File Tersebut Sudah Ada</code></small>';
                    }else{
                        $UpdateFile = mysqli_query($Conn,"UPDATE file_list SET 
                            label='$label_file',
                            kategori='$kategori'
                        WHERE id_file_list='$id_file_list'") or die(mysqli_error($Conn)); 
                        if($UpdateFile){
                            $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Edit File");
                            if($SimpanLog=="Success"){
                                echo '<small class="text-success" id="NotifikasiEditFileBerhasil">Success</small>';
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
?>