<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_bucket'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Bucket Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_bucket=$_POST['id_bucket'];
        $id_akses=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_akses');
        $id_api_key=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_api_key');
?>
        <input type="hidden" name="id_bucket" value="<?php echo "$id_bucket"; ?>">
        <input type="hidden" name="id_api_key" value="<?php echo "$id_api_key"; ?>">
        <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="button" class="btn btn-sm btn-rounded btn-block btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalPilihBucket" data-id="<?php echo "$id_api_key";?>">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="label_file">Label</label>
                <input type="text" name="label_file" id="label_file" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" list="kategori_list" class="form-control">
                <datalist id="kategori_list">
                    <?php
                        $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM file_list");
                        while ($data = mysqli_fetch_array($query)) {
                            $kategori= $data['kategori'];
                            echo '<option value="'.$kategori.'">';
                        }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="file_saya">Upload File</label>
                <input type="file" name="file_saya" id="file_saya" class="form-control">
                <small></small>
            </div>
        </div>
<?php } ?>