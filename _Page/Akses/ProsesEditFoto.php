<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        echo '<small class="text-danger">Silahkan reload halaman dan login terlebih dulu</small>';
    }else{
        //Time Zone
        date_default_timezone_set('Asia/Jakarta');
        //Time Now Tmp
        $now=date('Y-m-d H:i:s');
        //Id Akses
        if(empty($_POST['id_akses'])){
            echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
        }else{
            $id_akses=$_POST['id_akses'];
            if(empty($_FILES['foto']['name'])){
                echo '<small class="text-danger">File foto tidak boleh kosong</small>';
            }else{
                //Buka Foto Lama
                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                $FotoLama=$DataDetailAkses['foto'];
                if(!empty($DataDetailAkses['foto'])){
                    $FotoLama = "../../assets/img/User/".$FotoLama;
                }else{
                    $FotoLama = "";
                }
                //nama gambar
                $nama_gambar=$_FILES['foto']['name'];
                //ukuran gambar
                $ukuran_gambar = $_FILES['foto']['size']; 
                //tipe
                $tipe_gambar = $_FILES['foto']['type']; 
                //sumber gambar
                $tmp_gambar = $_FILES['foto']['tmp_name'];
                $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                $FileNameRand=$key;
                $Pecah = explode("." , $nama_gambar);
                $BiasanyaNama=$Pecah[0];
                $Ext=$Pecah[1];
                $namabaru = "$FileNameRand.$Ext";
                $path = "../../assets/img/User/".$namabaru;
                if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                    if($ukuran_gambar<2000000){
                        if(move_uploaded_file($tmp_gambar, $path)){
                            $ValidasiGambar="Valid";
                            //Hapus Foto Lama
                            unlink($FotoLama);
                        }else{
                            $ValidasiGambar="Upload gambar gagal";
                        }
                    }else{
                        $ValidasiGambar="File gambar tidak boleh lebih dari 2 Mb";
                    }
                }else{
                    $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                }
                //Apabila validasi upload valid maka simpan di database
                if($ValidasiGambar!=="Valid"){
                    echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                }else{
                    $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                        foto='$namabaru'
                    WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                    if($UpdateAkses){
                        $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Akses","Ubah Foto");
                        if($SimpanLog=="Success"){
                            echo '<small class="text-success" id="NotifikasiUbahFotoBerhasil">Success</small>';
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
?>