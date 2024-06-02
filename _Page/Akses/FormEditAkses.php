<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama= $DataDetailAkses['nama'];
        $kontak= $DataDetailAkses['kontak'];
        $email = $DataDetailAkses['email'];
        $Akses= $DataDetailAkses['akses'];
?>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama_akses"><b>Nama Lengkap</b></label> 
            <input type="text" name="nama" id="nama_akses_edit" class="form-control" value="<?php echo "$nama"; ?>">
            <small>Maksimal 50 karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="kontak_akses"><b>Kontak</b></label>
            <input type="text" name="kontak" id="kontak_akses_edit" class="form-control" value="<?php echo "$kontak"; ?>">
            <small>6-15 Karakter Numerik</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="email_akses"><b>Email</b></label>
            <input type="email" name="email" id="email_akses_edit" class="form-control" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="akses"><b>Akses</b></label>
            <select name="akses" id="akses" class="form-control">
                <option <?php if($Akses==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($Akses=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                <option <?php if($Akses=="Customer"){echo "selected";} ?> value="Customer">Customer</option>
            </select>
        </div>
    </div>
<?php } ?>