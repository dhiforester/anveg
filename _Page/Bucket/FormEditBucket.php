<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_bucket
    if(empty($_POST['id_bucket'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID Bucket Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_bucket=$_POST['id_bucket'];
        $id_akses=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_akses');
        $id_api_key=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_api_key');
        $nama=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
        $deskripsi=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'deskripsi');
        $maksimal=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'maksimal');
?>
    <input type="hidden" name="id_bucket" value="<?php echo "$id_bucket"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama">Nama Bucket</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
            <small>Maksimal 50 karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo "$deskripsi"; ?></textarea>
            <small>Maksimal 100 karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="maksimal">Maksimal Penyimpanan</label>
            <select name="maksimal" id="maksimal" class="form-control">
                <option <?php if($maksimal=="10000000"){echo "selected";} ?> value="10">10 Mb</option>
                <option <?php if($maksimal=="50000000"){echo "selected";} ?> value="50">50 Mb</option>
                <option <?php if($maksimal=="100000000"){echo "selected";} ?> value="100">100 Mb</option>
                <option <?php if($maksimal=="250000000"){echo "selected";} ?> value="250">250 Mb</option>
                <option <?php if($maksimal=="500000000"){echo "selected";} ?> value="500">500 Mb</option>
                <option <?php if($maksimal=="1000000000"){echo "selected";} ?> value="1000">1 Gb</option>
                <option <?php if($maksimal=="5000000000"){echo "selected";} ?> value="5000">5 Gb</option>
                <option <?php if($maksimal=="10000000000"){echo "selected";} ?> value="10000">10 Gb</option>
                <option <?php if($maksimal=="50000000000"){echo "selected";} ?> value="50000">50 Gb</option>
                <option <?php if($maksimal=="100000000000"){echo "selected";} ?> value="100000">100 Gb</option>
            </select>
        </div>
    </div>
<?php } ?>