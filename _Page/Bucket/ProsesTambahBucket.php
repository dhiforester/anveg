<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST['id_akses'])){
            echo '<span class="text-danger">ID Akses Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['id_api_key'])){
                echo '<span class="text-danger">ID Api Key Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['nama'])){
                    echo '<span class="text-danger">Nama Bucket Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['deskripsi'])){
                        echo '<span class="text-danger">Deskripsi Bucket Tidak Boleh Kosong!</span>';
                    }else{
                        if(empty($_POST['maksimal'])){
                            echo '<span class="text-danger">Maksimal Limit File Bucket Tidak Boleh Kosong!</span>';
                        }else{
                            $id_akses=$_POST['id_akses'];
                            $id_api_key=$_POST['id_api_key'];
                            $nama=$_POST['nama'];
                            $deskripsi=$_POST['deskripsi'];
                            $maksimal=$_POST['maksimal'];
                            //Ubah maksimal dalam satuan bit
                            $maksimal=$maksimal*1000000;
                            //Validasi Jumlah Karakter
                            $KarakterNama=strlen($nama);
                            $KarakterDeskripsi=strlen($deskripsi);
                            if($KarakterNama>50){
                                echo '<small class="text-danger">Nama Api Key Tidak Boleh Lebih Dari 50 Karakter</small>';
                            }else{
                                if($KarakterDeskripsi>100){
                                    echo '<small class="text-danger">Deskripsi Tidak Boleh Lebih Dari 100 Karakter</small>';
                                }else{
                                    //Validasi Nama Bucket
                                    $ValidasiNamaBucket=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_akses='$id_akses' AND id_api_key='$id_api_key' AND nama='$nama'"));
                                    if(!empty($ValidasiNamaBucket)){
                                        echo '<small class="text-danger">Nama Bucket Tersebut Sudah Ada</small>';
                                    }else{
                                        $entry="INSERT INTO bucket (
                                            id_akses,
                                            id_api_key,
                                            nama,
                                            deskripsi,
                                            maksimal
                                        ) VALUES (
                                            '$id_akses',
                                            '$id_api_key',
                                            '$nama',
                                            '$deskripsi',
                                            '$maksimal'
                                        )";
                                        $Input=mysqli_query($Conn, $entry);
                                        if($Input){
                                            $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Bucket","Tambah Bucket");
                                            if($SimpanLog=="Success"){
                                                echo '<small class="text-success" id="NotifikasiTambahBucketBerhasil">Success</small>';
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
    }
?>