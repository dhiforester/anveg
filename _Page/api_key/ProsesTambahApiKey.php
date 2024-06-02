<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    //Validasi Data Tidak Boleh Kosong
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        if(empty($_POST["id_akses"])){
            echo '<small class="text-danger">ID Akses Tidak Boleh Kosong</small>';
        }else{
            if(empty($_POST["nama"])){
                echo '<small class="text-danger">Nama Api Key Tidak Boleh Kosong</small>';
            }else{
                if(empty($_POST["deskripsi"])){
                    echo '<small class="text-danger">Deskripsi Api Key Tidak Boleh Kosong</small>';
                }else{
                    if(empty($_POST["api_key"])){
                        echo '<small class="text-danger">Api Key Tidak Boleh Kosong</small>';
                    }else{
                        $id_akses=$_POST['id_akses'];
                        $nama=$_POST['nama'];
                        $deskripsi=$_POST['deskripsi'];
                        $api_key=$_POST['api_key'];
                        $tanggal=date('Y-m-d H:i:s');
                        //Validitas id_akses
                        $IdAkses=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_akses');
                        if(empty($IdAkses)){
                            echo '<small class="text-danger">ID Akses Yang Anda Input Tidak Valid Atau Tidak Ada Pada Database</small>';
                        }else{
                            //Validasi Karakter
                            $KarakterNama=strlen($nama);
                            $KarakterDeskripsi=strlen($deskripsi);
                            $KarakterApiKey=strlen($api_key);
                            if($KarakterNama>50){
                                echo '<small class="text-danger">Nama Api Key Tidak Boleh Lebih Dari 50 Karakter</small>';
                            }else{
                                if($KarakterDeskripsi>200){
                                    echo '<small class="text-danger">Deskripsi Tidak Boleh Lebih Dari 200 Karakter</small>';
                                }else{
                                    if($KarakterApiKey>32){
                                        echo '<small class="text-danger">API Key Tidak Boleh Lebih Dari 32 Karakter</small>';
                                    }else{
                                        //Validasi Karakter
                                        if(validasiInput($nama)!=="Success"){
                                            echo '<small class="text-danger">Nama Hanya boleh diisi dengan huruf, angka atau spasi</small>';
                                        }else{
                                            if(validasiInput($deskripsi)!=="Success"){
                                                echo '<small class="text-danger">Deskripsi Hanya boleh diisi dengan huruf, angka atau spasi</small>';
                                            }else{
                                                if(validasiInput($api_key)!=="Success"){
                                                    echo '<small class="text-danger">API Key Hanya boleh diisi dengan huruf, angka atau spasi</small>';
                                                }else{
                                                    $nama = mysqli_real_escape_string($Conn, $nama);
                                                    $deskripsi = mysqli_real_escape_string($Conn, $deskripsi);
                                                    $api_key = mysqli_real_escape_string($Conn, $api_key);
                                                    $entry="INSERT INTO api_key (
                                                        id_akses,
                                                        nama,
                                                        deskripsi,
                                                        api_key,
                                                        tanggal
                                                    ) VALUES (
                                                        '$id_akses',
                                                        '$nama',
                                                        '$deskripsi',
                                                        '$api_key',
                                                        '$tanggal'
                                                    )";
                                                    $Input=mysqli_query($Conn, $entry);
                                                    if($Input){
                                                        $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Api Key","Tambah Api Key");
                                                        if($SimpanLog=="Success"){
                                                            echo '<small class="text-success" id="NotifikasiTambahApiKeyBerhasil">Success</small>';
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
            }
        }
    }
?>