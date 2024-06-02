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
        if(empty($_POST['id_bucket'])){
            echo '<small><code class="text-danger">ID Bucket Tidak Boleh Kosong!</code></small>';
        }else{
            if(empty($_POST['id_api_key'])){
                echo '<small><code class="text-danger">ID Api Key Tidak Boleh Kosong!</code></small>';
            }else{
                if(empty($_POST['id_akses'])){
                    echo '<small><code class="text-danger">ID Akses Tidak Boleh Kosong!</code></small>';
                }else{
                    if(empty($_POST['label_file'])){
                        echo '<small><code class="text-danger">Label File Boleh Kosong!</code></small>';
                    }else{
                        if(empty($_POST['kategori'])){
                            echo '<small><code class="text-danger">Kategori File Boleh Kosong!</code></small>';
                        }else{
                            if(empty($_FILES['file_saya']['name'])){
                                echo '<small><code class="text-danger">File Boleh Kosong!</code></small>';
                            }else{
                                $id_bucket=$_POST['id_bucket'];
                                $id_api_key=$_POST['id_api_key'];
                                $id_akses=$_POST['id_akses'];
                                $label_file=$_POST['label_file'];
                                $kategori=$_POST['kategori'];
                                //Informasi file
                                $ukuran_file = $_FILES['file_saya']['size']; 
                                $tipe_file = $_FILES['file_saya']['type']; 
                                $tmp_gambar = $_FILES['file_saya']['tmp_name'];
                                $UkuranMega=$ukuran_file/1000000;
                                $UkuranMega=round($UkuranMega);
                                //Validitas Tipe File
                                $extensi_file=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'extensi_file');
                                if(empty($extensi_file)){
                                    echo '<small><code class="text-danger">Tipe File ('.$tipe_file.') Tersebut Tidak Kompetebel</code></small>';
                                }else{
                                    $maksimum_upload=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'maksimum_upload');
                                    if($maksimum_upload<$ukuran_file){
                                        echo '<small><code class="text-danger">Ukuran File Tersebut ('.$UkuranMega.' Mb) Terlalu Besar</code></small>';
                                    }else{
                                        //Buat Nama File Baru
                                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                        $FileNameRand=$key;
                                        $NamaFileBaru = "$FileNameRand$extensi_file";
                                        //Validasi Duplikat
                                        $ValidasiLabelDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE label='$label_file' AND id_bucket='$id_bucket'"));
                                        if(!empty($ValidasiLabelDuplikat)){
                                            echo '<small><code class="text-danger">Label File Tersebut Sudah Ada</code></small>';
                                        }else{
                                            $path = "../../storage/".$NamaFileBaru;
                                            if(move_uploaded_file($tmp_gambar, $path)){
                                                //Membuat File Token
                                                $file_token=generateRandomString('16');
                                                $entry="INSERT INTO file_list (
                                                    id_akses,
                                                    id_api_key,
                                                    id_bucket,
                                                    nama,
                                                    label,
                                                    kategori,
                                                    tipe_file,
                                                    ukuran,
                                                    tanggal,
                                                    file_token
                                                ) VALUES (
                                                    '$id_akses',
                                                    '$id_api_key',
                                                    '$id_bucket',
                                                    '$NamaFileBaru',
                                                    '$label_file',
                                                    '$kategori',
                                                    '$tipe_file',
                                                    '$ukuran_file',
                                                    '$tanggal',
                                                    '$file_token'
                                                )";
                                                $Input=mysqli_query($Conn, $entry);
                                                if($Input){
                                                    $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","File","Tambah File File");
                                                    if($SimpanLog=="Success"){
                                                        echo '<small class="text-success" id="NotifikasiTambahFileBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">'.$SimpanLog.'</small>';
                                                    }
                                                }else{
                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                                }
                                            }else{
                                                echo '<small class="text-danger">Upload file gagal</small>';
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