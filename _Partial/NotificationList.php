<?php
    //Karena Ini Di running Dengan JS maka Panggil Ulang Koneksi
    include "../_Config/Connection.php";
    include "../_Config/Session.php";
    //Menghitung Jumlah Notifikasi
    $JumlahNotifikasi=0;
    //Apabila Tidak ada notifgikasi
    if(empty($JumlahNotifikasi)){
        echo '<li class="dropdown-header">';
        echo '  No notifications found';
        echo '</li>';
    }else{
        if($SessionAkses=="Customer Service"){
            //Apabila Ada
            echo '<li class="dropdown-header">';
            echo '  You have '.$JumlahNotifikasi.' new notifications';
            echo '</li>';
            //ADMIN
            if(!empty($JumlahMenungguVerifikasiPembayaran)){
                echo '<li><hr class="dropdown-divider"></li>';
                $query = mysqli_query($Conn, "SELECT*FROM pembayaran WHERE status='Pending'");
                while ($data = mysqli_fetch_array($query)) {
                    $id_transaksi= $data['id_transaksi'];
                    $nama= $data['nama'];
                    echo '<li class="notification-item">';
                    echo '  <i class="bi bi-check-circle text-success"></i>';
                    echo '  <div>';
                    echo '      <h4><a href="index.php?Page=Transaksi&Sub=DetailTransaksi&id='.$id_transaksi.'">'.$nama.'</a></h4>';
                    echo '      <p>Menunggu verifikasi pembayaran</p>';
                    echo '  </div>';
                    echo '</li>';
                }
            }
            if(!empty($JumlahChatBelumDibaca)){
                echo '<li><hr class="dropdown-divider"></li>';
                echo '<li class="notification-item">';
                echo '  <i class="bi bi-check-circle text-success"></i>';
                echo '  <div>';
                echo '      <h4><a href="index.php?Page=Chating">Chat</a></h4>';
                echo '      <p>Ada '.$JumlahChatBelumDibaca.' Pesan Baru </p>';
                echo '  </div>';
                echo '</li>';
            }
            if(!empty($JumlahTransaksiLunasBelumDikirim)){
                echo '<li><hr class="dropdown-divider"></li>';
                $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE status_pembayaran='Lunas' AND status_pengiriman='Pending'");
                while ($data = mysqli_fetch_array($query)) {
                    $id_transaksi= $data['id_transaksi'];
                    $nama= $data['nama_pelanggan'];
                    echo '<li class="notification-item">';
                    echo '  <i class="bi bi-check-circle text-success"></i>';
                    echo '  <div>';
                    echo '      <h4><a href="index.php?Page=Transaksi&Sub=DetailTransaksi&id='.$id_transaksi.'">'.$nama.'</a></h4>';
                    echo '      <p>Barang Menunggu Dikirim</p>';
                    echo '  </div>';
                    echo '</li>';
                }
            }
            if(!empty($JumlahTestimoniBelumDiPublish)){
                echo '<li><hr class="dropdown-divider"></li>';
                echo '<li class="notification-item">';
                echo '  <i class="bi bi-check-circle text-success"></i>';
                echo '  <div>';
                echo '      <h4><a href="index.php?Page=Testimoni">Testimoni</a></h4>';
                echo '      <p>Ada '.$JumlahTestimoniBelumDiPublish.' Menunggu Publish</p>';
                echo '  </div>';
                echo '</li>';
            }
        }else{
            echo '<li class="dropdown-header">';
            echo '  No notifications found';
            echo '</li>';
        }
    }
?>