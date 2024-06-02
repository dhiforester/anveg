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
        //Validasi nama tidak boleh kosong
        if(empty($_POST['nama'])){
            echo '<small class="text-danger">Nama tidak boleh kosong</small>';
        }else{
            //Validasi kontak tidak boleh kosong
            if(empty($_POST['kontak'])){
                echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
            }else{
                //Validasi kontak tidak boleh lebih dari 15 karakter
                $JumlahKarakterKontak=strlen($_POST['kontak']);
                if($JumlahKarakterKontak>15||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $_POST['kontak'])){
                    echo '<small class="text-danger">Kontak terdiri dari 6-15 karakter numerik</small>';
                }else{
                    //Validasi kontak tidak boleh duplikat
                    $kontak=$_POST['kontak'];
                    $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE kontak='$kontak'"));
                    if(!empty($ValidasiKontakDuplikat)){
                        echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                    }else{
                        //Validasi email tidak boleh kosong
                        if(empty($_POST['email'])){
                            echo '<small class="text-danger">Email tidak boleh kosong</small>';
                        }else{
                            //Validasi email duplikat
                            $email=$_POST['email'];
                            $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE email='$email'"));
                            if(!empty($ValidasiEmailDuplikat)){
                                echo '<small class="text-danger">Email sudah digunakan</small>';
                            }else{
                                //Validasi akses tidak boleh kosong
                                if(empty($_POST['akses'])){
                                    echo '<small class="text-danger">Status akses tidak boleh kosong</small>';
                                }else{
                                    //Validasi Password tidak boleh kosong
                                    if(empty($_POST['password1'])){
                                        echo '<small class="text-danger">Password tidak boleh kosong</small>';
                                    }else{
                                        if($_POST['password1']!==$_POST['password2']){
                                            echo '<small class="text-danger">Password Tidak sama</small>';
                                        }else{
                                            //Validasi jumlah dan jenis karakter password
                                            $JumlahKarakterPassword=strlen($_POST['password1']);
                                            if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password1'])){
                                                echo '<small class="text-danger">Password Terdiri Dari Huruf Dan Angka (6-20 Karakter)</small>';
                                            }else{
                                                $akses=$_POST['akses'];
                                                //Variabel Lainnya
                                                $nama=$_POST['nama'];
                                                $kontak=$_POST['kontak'];
                                                $email=$_POST['email'];
                                                $akses=$_POST['akses'];
                                                $password1=$_POST['password1'];
                                                $password1=MD5($password1);
                                                //Validasi jumlah karakter
                                                $JumlahKarakterNama=strlen($nama);
                                                $JumlahKarakterEmail=strlen($email);
                                                if($JumlahKarakterNama>50){
                                                    echo '<small class="text-danger">Nama tidak boleh lebih dari 50 karakter</small>';
                                                }else{
                                                    if($JumlahKarakterEmail>50){
                                                        echo '<small class="text-danger">Email tidak boleh lebih dari 50 karakter</small>';
                                                    }else{
                                                        //Validasi Gambar
                                                        if(!empty($_FILES['image_akses']['name'])){
                                                            //nama gambar
                                                            $nama_gambar=$_FILES['image_akses']['name'];
                                                            //ukuran gambar
                                                            $ukuran_gambar = $_FILES['image_akses']['size']; 
                                                            //tipe
                                                            $tipe_gambar = $_FILES['image_akses']['type']; 
                                                            //sumber gambar
                                                            $tmp_gambar = $_FILES['image_akses']['tmp_name'];
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
                                                                    }else{
                                                                        $ValidasiGambar="Upload file gambar gagal";
                                                                    }
                                                                }else{
                                                                    $ValidasiGambar="File gambar tidak boleh lebih dari 2 mb";
                                                                }
                                                            }else{
                                                                $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                                                            }
                                                        }else{
                                                            $ValidasiGambar="Valid";
                                                            $namabaru="";
                                                        }
                                                        //Apabila validasi upload valid maka simpan di database
                                                        if($ValidasiGambar!=="Valid"){
                                                            echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                                                        }else{
                                                            $entry="INSERT INTO akses (
                                                                nama,
                                                                kontak,
                                                                email,
                                                                password,
                                                                akses,
                                                                foto
                                                            ) VALUES (
                                                                '$nama',
                                                                '$kontak',
                                                                '$email',
                                                                '$password1',
                                                                '$akses',
                                                                '$namabaru'
                                                            )";
                                                            $Input=mysqli_query($Conn, $entry);
                                                            if($Input){
                                                                $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Akses","Tambah Akses");
                                                                if($SimpanLog=="Success"){
                                                                    echo '<small class="text-success" id="NotifikasiTambahAksesBerhasil">Success</small>';
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
        }
    }
?>