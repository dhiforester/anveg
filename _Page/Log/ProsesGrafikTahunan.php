<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    $a=1;
    $b=12;
    $GetTahun=date('Y');
    for ( $i =$a; $i<=$b; $i++ ){
        //Zero pading
        $BulanNomor = sprintf("%02d", $i);
        $BulanList = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $NamaBulan=$BulanList[$BulanNomor];
        $KeywordGrafik="$GetTahun-$BulanNomor";
        $JumlahLog=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM log WHERE tanggal like '%$KeywordGrafik%'"));
        $data [] = array(
            'x' => $NamaBulan,
            'y' => $JumlahLog
        );
    }
    $FileName="GrafikTahunan.json";
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($FileName, $jsonfile);
?>