<?php
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    if(empty($_POST['periode_awal'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-danger text-center">';
        echo '      <small>Isi Terlebih Dulu Informasi Periode Awal</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['periode_akhir'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-danger text-center">';
            echo '      <small>Isi Terlebih Dulu Informasi Periode Akhir</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $periode_awal=$_POST['periode_awal'];
            $periode_akhir=$_POST['periode_akhir'];
            $JumlahTransaksi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi WHERE tanggal>='$periode_awal' AND tanggal<='$periode_akhir'"));
            if(empty($JumlahTransaksi)){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-danger text-center">';
                echo '      <small>Tidak ada data transaksi pada periode tersebut</small>';
                echo '  </div>';
                echo '</div>';
            }else{
                echo '<div class="row">';
                echo '  <div class="col-md-12">';
                echo '      <div class="table table-responsive">';
                echo '          <table class="table table-bordered table-hover">';
                echo '              <thead>';
                echo '                  <tr>';
                echo '                      <th class="text-center"><b>No</b></th>';
                echo '                      <th class="text-center"><b>Tanggal</b></th>';
                echo '                      <th class="text-center"><b>Pelanggan</b></th>';
                echo '                      <th class="text-center"><b>Subtotal</b></th>';
                echo '                      <th class="text-center"><b>Ongkir</b></th>';
                echo '                      <th class="text-center"><b>Jumlah</b></th>';
                echo '                      <th class="text-center"><b>Pembayaran</b></th>';
                echo '                      <th class="text-center"><b>Pengiriman</b></th>';
                echo '                  </tr>';
                echo '              </thead>';
                echo '              <tbody>';
                                    $no = 1;
                                    //KONDISI PENGATURAN MASING FILTER
                                    $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE tanggal>='$periode_awal' AND tanggal<='$periode_akhir'");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_transaksi= $data['id_transaksi'];
                                        $tanggal= $data['tanggal'];
                                        $nama_pelanggan= $data['nama_pelanggan'];
                                        $subtotal= $data['subtotal'];
                                        $ongkir= $data['ongkir'];
                                        $jumlah= $data['jumlah'];
                                        $status_pembayaran= $data['status_pembayaran'];
                                        $status_pengiriman= $data['status_pengiriman'];
                                        //Format Tanggal
                                        $strtotime=strtotime($tanggal);
                                        $FormatTanggal=date('d/m/Y H:i:s',$strtotime);
                                        //Format Rupiah
                                        $subtotal = "Rp " . number_format($subtotal,0,',','.');
                                        $ongkir = "Rp " . number_format($ongkir,0,',','.');
                                        $jumlah = "Rp " . number_format($jumlah,0,',','.');
                                        echo '<tr>';
                                        echo '  <td class="text-center">'.$no.'</td>';
                                        echo '  <td class="text-left">'.$FormatTanggal.'</td>';
                                        echo '  <td class="text-left">'.$nama_pelanggan.'</td>';
                                        echo '  <td class="text-right">'.$subtotal.'</td>';
                                        echo '  <td class="text-right">'.$ongkir.'</td>';
                                        echo '  <td class="text-right">'.$jumlah.'</td>';
                                        echo '  <td class="text-center">'.$status_pembayaran.'</td>';
                                        echo '  <td class="text-center">'.$status_pengiriman.'</td>';
                                        echo '</tr>';
                                        $no++;
                                    }
                echo '              </tbody>';
                echo '          </table>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }
        }
    }
?>