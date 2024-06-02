<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    $TahunIni=date('Y');
    $BulanIni=date('m');
    $HariIni=date('d');
    $JumlahJam=23;
    //Arraykan Tanggal
    $a=0;
    $b=$JumlahJam;
    for ( $i =$a; $i<=$b; $i++ ){
        //Zero pading
        $Jam = sprintf("%02d", $i);
        $KeywordGrafik="$TahunIni-$BulanIni-$HariIni $Jam";
        $JumlahLog=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM log WHERE tanggal like '%$KeywordGrafik%'"));
        $data [] = array(
            'x' => $Jam,
            'y' => $JumlahLog
        );
    }
    $FileName="GrafikHarian.json";
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($FileName, $jsonfile);
?>