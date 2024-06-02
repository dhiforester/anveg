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
            //Validasi Password tidak boleh kosong
            if(empty($_POST['password1'])){
                echo '<small class="text-danger">Password tidak boleh kosong</small>';
            }else{
                if($_POST['password1']!==$_POST['password2']){
                    echo '<small class="text-danger">Password tidak sama</small>';
                }else{
                    //Validasi jumlah dan jenis karakter password
                    $JumlahKarakterPassword=strlen($_POST['password1']);
                    if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password1'])){
                        echo '<small class="text-danger">Password hanya boleh terdiri dari 6-20 karakter numerik dan huruf</small>';
                    }else{                 
                        //Variabel Lainnya
                        $password1=$_POST['password1'];
                        //md5
                        $password1=MD5($password1);                          
                        $UpdatePassword = mysqli_query($Conn,"UPDATE akses SET 
                            password='$password1'
                        WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                        if($UpdatePassword){
                            $SimpanLog=AddLog($Conn,$SessionIdAkses,"0","Akses","Ubah Password");
                            if($SimpanLog=="Success"){
                                echo '<small class="text-success" id="NotifikasiUbahPasswordBerhasil">Success</small>';
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