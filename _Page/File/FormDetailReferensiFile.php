<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_file_referensi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Referensi Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_referensi=$_POST['id_file_referensi'];
        $tipe_file=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'tipe_file');
?>
        <input type="hidden" name="id_bucket" value="<?php echo "$id_bucket"; ?>">
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
                <label for="tipe_file">Upload File</label>
                <input type="file" name="tipe_file" id="tipe_file" class="form-control">
                <small></small>
            </div>
        </div>
<?php } ?>