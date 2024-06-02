<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST['id_bucket'])){
            echo '<span class="text-danger">ID Bucket Tidak Boleh Kosong!</span>';
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
                        $id_bucket=$_POST['id_bucket'];
                        $nama=$_POST['nama'];
                        $deskripsi=$_POST['deskripsi'];
                        $maksimal=$_POST['maksimal'];
                        //Buka File Lama
                        $NamaLama=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
                        $id_akses=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_akses');
                        $id_api_key=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_api_key');
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
                                if($NamaLama==$nama){
                                    $ValidasiNamaBucket="";
                                }else{
                                    $ValidasiNamaBucket=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_akses='$id_akses' AND id_api_key='$id_api_key' AND nama='$nama'"));
                                }
                                //Validasi Nama Bucket
                                if(!empty($ValidasiNamaBucket)){
                                    echo '<small class="text-danger">Nama Bucket Tersebut Sudah Ada</small>';
                                }else{
                                    $UpdateBucket = mysqli_query($Conn,"UPDATE bucket SET 
                                        nama='$nama',
                                        deskripsi='$deskripsi',
                                        maksimal='$maksimal'
                                    WHERE id_bucket='$id_bucket'") or die(mysqli_error($Conn)); 
                                    if($UpdateBucket){
                                        $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Bucket","Edit Bucket");
                                        if($SimpanLog=="Success"){
                                            echo '<small class="text-success" id="NotifikasiEditBucketBerhasil">Success</small>';
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