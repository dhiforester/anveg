<?php
    //Koneksi dan Setting
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    include '../../../vendor/autoload.php';
    //SETTING HALAMAN WEB
    $title_page="Madu Sport";
    $kata_kunci="Alat olahraga, CRM, madu sport, Kuningan";
    $deskripsi="Toko peralatan olahraga paling lengkap dikuningan";
    $alamat_bisnis="Jl. Pramuka No.327, Purwawinangun, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45512";
    $email_bisnis="madu_sport@gmail.com";
    $telepon_bisnis="(0232)8776240";
    $favicon="logo.png";
    $logo= "logo.png";
    //Validasi Variabel
    if(empty($_POST['PeriodeAwal'])){
        echo "Periode Awal Tidak Boleh Kosong";
    }else{
        if(empty($_POST['PeriodeAkhir'])){
            echo "Periode Akhir Tidak Boleh Kosong";
        }else{
            if(empty($_POST['FormatLaporan'])){
                echo "Format Laporan Tidak Boleh Kosong";
            }else{
                $PeriodeAwal=$_POST['PeriodeAwal'];
                $PeriodeAkhir=$_POST['PeriodeAkhir'];
                $FormatLaporan=$_POST['FormatLaporan'];
                //Format PDF
                if($FormatLaporan=="PDF"){
                    $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
                    $nama_dokumen= "Laporan Transaksi";
                    $mpdf->AddPage('L');
                    $html='<style>@page *{margin-top: 0px;}</style>'; 
                    //Beginning Buffer to save PHP variables and HTML tags
                    ob_start();
                }
?>
    <html>
        <head>
            <title>Laporan</title>
            <style type="text/css">
                @page {
                    margin-top: 1cm;
                    margin-bottom: 1cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                }
                body {
                    background-color: #FFF;
                    font-family: arial;
                }
                table{
                    border-collapse: collapse;
                    margin-top:10px;
                }
                table.kostum tr td {
                    border:none;
                    color:#333;
                    border-spacing: 0px;
                    padding: 2px;
                    border-collapse: collapse;
                    font-size:12px;
                }
                table.data tr td {
                    border: 1px solid #666;
                    color:#333;
                    border-spacing: 0px;
                    padding: 10px;
                    border-collapse: collapse;
                }
            </style>
        </head>
        <body>
            <table width="100%">
                <tr>
                    <td align="center">
                        <h3>
                            <b>LAPORAN TRANSAKSI</b>
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <b><?php echo "$title_page";?></b>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <small><?php echo "$alamat_bisnis";?></small>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <small><?php echo "$telepon_bisnis";?></small>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <small><?php echo "$email_bisnis";?></small>
                    </td>
                </tr>
            </table>
            <table class="data" width="100%" cellspacing="0">
                <tr>
                    <td align="center"><b class="sub-title">No</b></td>
                    <td align="center"><b class="sub-title">Tanggal</b></td>
                    <td align="center"><b class="sub-title">Pelanggan</b></td>
                    <td align="center"><b class="sub-title">Subtotal</b></td>
                    <td align="center"><b class="sub-title">Ongkir</b></td>
                    <td align="center"><b class="sub-title">Jumlah</b></td>
                    <td align="center"><b class="sub-title">Pembayaran</b></td>
                    <td align="center"><b class="sub-title">Pengiriman</b></td>
                </tr>
                <?php
                    $no = 1;
                    $JumlahTotalTransaksi=0;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE tanggal>='$PeriodeAwal' AND tanggal<='$PeriodeAkhir'");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_transaksi= $data['id_transaksi'];
                        $tanggal= $data['tanggal'];
                        $nama_pelanggan= $data['nama_pelanggan'];
                        $subtotal= $data['subtotal'];
                        $ongkir= $data['ongkir'];
                        $jumlah= $data['jumlah'];
                        $status_pembayaran= $data['status_pembayaran'];
                        $status_pengiriman= $data['status_pengiriman'];
                        //Jumlah Transaksi
                        $JumlahTotalTransaksi=$JumlahTotalTransaksi+$jumlah;
                        //Format Tanggal
                        $strtotime=strtotime($tanggal);
                        $FormatTanggal=date('d/m/Y H:i:s',$strtotime);
                        //Format Rupiah
                        $subtotal = "Rp " . number_format($subtotal,0,',','.');
                        $ongkir = "Rp " . number_format($ongkir,0,',','.');
                        $jumlah = "Rp " . number_format($jumlah,0,',','.');
                        echo '<tr>';
                        echo '  <td align="center">'.$no.'</td>';
                        echo '  <td align="left">'.$FormatTanggal.'</td>';
                        echo '  <td align="left">'.$nama_pelanggan.'</td>';
                        echo '  <td align="right">'.$subtotal.'</td>';
                        echo '  <td align="right">'.$ongkir.'</td>';
                        echo '  <td align="right">'.$jumlah.'</td>';
                        echo '  <td align="center">'.$status_pembayaran.'</td>';
                        echo '  <td align="center">'.$status_pengiriman.'</td>';
                        echo '</tr>';
                        $no++;
                    }
                    $JumlahTotalTransaksi = "Rp " . number_format($JumlahTotalTransaksi,0,',','.');
                    echo '<tr>';
                    echo '  <td align="center" colspan="5">JUMLAH TOTAL</td>';
                    echo '  <td align="right">'.$JumlahTotalTransaksi.'</td>';
                    echo '  <td align="center"></td>';
                    echo '  <td align="center"></td>';
                    echo '</tr>';
                ?>
            </table>
        </body>
    </html>
<?php
                if($FormatLaporan=="PDF"){
                    $html = ob_get_contents();
                    ob_end_clean();
                    $mpdf->WriteHTML(utf8_encode($html));
                    $mpdf->Output($nama_dokumen.".pdf" ,'I');
                    exit;
                }
            }
        }
    }
?>