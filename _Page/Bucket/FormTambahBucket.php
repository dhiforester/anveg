<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_api_key'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Api Key Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_api_key=$_POST['id_api_key'];
        //Buak id_akses
        $id_akses=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'id_akses');
?>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <input type="hidden" name="id_api_key" value="<?php echo "$id_api_key"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama">Nama Bucket</label>
            <input type="text" name="nama" id="nama" class="form-control">
            <small>Maksimal 50 karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            <small>Maksimal 100 karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="maksimal">Maksimal Penyimpanan</label>
            <select name="maksimal" id="maksimal" class="form-control">
                <option value="10">10 Mb</option>
                <option value="50">50 Mb</option>
                <option value="100">100 Mb</option>
                <option value="250">250 Mb</option>
                <option value="500">500 Mb</option>
                <option value="1000">1 Gb</option>
                <option value="5000">5 Gb</option>
                <option value="10000">10 Gb</option>
                <option value="50000">50 Gb</option>
                <option value="100000">100 Gb</option>
            </select>
        </div>
    </div>
<?php
    }
?>