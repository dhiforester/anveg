<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    $TahunIni=date('Y');
    $BulanIni=date('m');
    $JumlahHari=date('t');
    //Arraykan Tanggal
    $a=1;
    $b=$JumlahHari;
    for ( $i =$a; $i<=$b; $i++ ){
        //Zero pading
        $Tanggal = sprintf("%02d", $i);
        $KeywordGrafik="$TahunIni-$BulanIni-$Tanggal";
        $JumlahLog=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM log WHERE tanggal like '%$KeywordGrafik%'"));
        $data [] = array(
            'x' => $Tanggal,
            'y' => $JumlahLog
        );
    }
    $FileName="GrafikBulanan.json";
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($FileName, $jsonfile);
?>