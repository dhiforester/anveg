<?php
    //Menangkap seasson kemudian menampilkannya
    if(empty($_SESSION["id_akses"])){
        header("Location:Login.php");
    }else{
        $SessionIdAkses=$_SESSION ["id_akses"];
        //Inisiasi data akses dari database
        $QuerySessionAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
        $DataSessionAkses = mysqli_fetch_array($QuerySessionAkses);
        //Apabila data akses ada
        if(!empty($DataSessionAkses['id_akses'])){
            //rincian profile user
            $SessionNama= $DataSessionAkses['nama'];
            $SessionEmail= $DataSessionAkses['email'];
            $SessionKontak= $DataSessionAkses['kontak'];
            $SessionPassword= $DataSessionAkses['password'];
            $SessionAkses= $DataSessionAkses['akses'];
            if(!empty($DataSessionAkses['foto'])){
                $SessionGambar= $DataSessionAkses['foto'];
            }else{
                $SessionGambar="No-Image.png";
            }
        }else{
            header("Location:Login.php");
        }
    }
?>
