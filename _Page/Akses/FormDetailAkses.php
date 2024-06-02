<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID Akses Tidak Ditemukan.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama= $DataDetailAkses['nama'];
        $kontak= $DataDetailAkses['kontak'];
        $email = $DataDetailAkses['email'];
        $password= $DataDetailAkses['password'];
        $akses= $DataDetailAkses['akses'];
        if(empty($DataDetailAkses['foto'])){
            $gambar="No-Image.png";
        }else{
            $gambar=$DataDetailAkses['foto'];
        }
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-4 text-center">
            <img src="assets/img/User/<?php echo "$gambar"; ?>" alt="" width="70%" class="rounded-circle">
        </div>
        <div class="col-md-8">
            <ul>
                <li>
                    Nama Akses : <code class="text-secondary"><?php echo $nama; ?></code>
                </li>
                <li>
                    Kontak : <code class="text-secondary"><?php echo $kontak; ?></code>
                </li>
                <li>
                    Email : <code class="text-secondary"><?php echo $email; ?></code>
                </li>
                <li>
                    Akses : <code class="text-secondary"><?php echo $akses; ?></code>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php } ?>