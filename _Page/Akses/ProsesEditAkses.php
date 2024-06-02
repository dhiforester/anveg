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
            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
            $KontakLama= $DataDetailAkses['kontak'];
            $EmailLama = $DataDetailAkses['email'];
            //Validasi nama tidak boleh kosong
            if(empty($_POST['nama'])){
                echo '<small class="text-danger">Nama tidak boleh kosong</small>';
            }else{
                //Validasi kontak tidak boleh kosong
                if(empty($_POST['kontak'])){
                    echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
                }else{
                    //Validasi akses tidak boleh kosong
                    if(empty($_POST['akses'])){
                        echo '<small class="text-danger">Akses tidak boleh kosong</small>';
                    }else{
                        //Validasi kontak tidak boleh lebih dari 20 karakter
                        $JumlahKarakterKontak=strlen($_POST['kontak']);
                        if($JumlahKarakterKontak>15||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $_POST['kontak'])){
                            echo '<small class="text-danger">Kontak hanya boleh terdiri dari 6-15 karakter numerik</small>';
                        }else{
                            //Validasi kontak tidak boleh duplikat
                            $kontak_akses=$_POST['kontak'];
                            if($KontakLama==$kontak_akses){
                                $ValidasiKontakDuplikat=0;
                            }else{
                                $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE kontak='$kontak_akses'"));
                            }
                            if(!empty($ValidasiKontakDuplikat)){
                                echo '<small class="text-danger">Nomor kontak sudah terdaftar</small>';
                            }else{
                                //Validasi email tidak boleh kosong
                                if(empty($_POST['email'])){
                                    echo '<small class="text-danger">Email tidak boleh kosong</small>';
                                }else{
                                    //Validasi email duplikat
                                    $email_akses=$_POST['email'];
                                    if($EmailLama==$email_akses){
                                        $ValidasiEmailDuplikat=0;
                                    }else{
                                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE email='$email_akses'"));
                                    }
                                    if(!empty($ValidasiEmailDuplikat)){
                                        echo '<small class="text-danger">Email yang anda gunakan sudah terdaftar</small>';
                                    }else{
                                        //Variabel Lainnya
                                        $nama_akses=$_POST['nama'];
                                        $kontak_akses=$_POST['kontak'];
                                        $email_akses=$_POST['email'];
                                        $akses=$_POST['akses'];
                                        //Validasi jumlah karakter
                                        $JumlahKarakterNama=strlen($nama_akses);
                                        $JumlahKarakterEmail=strlen($email_akses);
                                        if($JumlahKarakterNama>50){
                                            echo '<small class="text-danger">Nama tidak boleh lebih dari 50 karakter</small>';
                                        }else{
                                            if($JumlahKarakterEmail>50){
                                                echo '<small class="text-danger">Email tidak boleh lebih dari 50 karakter</small>';
                                            }else{
                                                $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                                                    nama='$nama_akses',
                                                    kontak='$kontak_akses',
                                                    email='$email_akses',
                                                    akses='$akses'
                                                WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                                                if($UpdateAkses){
                                                    $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Akses","Edit Akses");
                                                    if($SimpanLog=="Success"){
                                                        echo '<small class="text-success" id="NotifikasiEditAksesBerhasil">Success</small>';
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
?>