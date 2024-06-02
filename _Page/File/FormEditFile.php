<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_file_list'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID File List Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_list=$_POST['id_file_list'];
        $label=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'label');
        $kategori=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'kategori');
?>
        <input type="hidden" name="id_file_list" value="<?php echo "$id_file_list"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="label_file">Label</label>
                <input type="text" name="label_file" id="label_file" class="form-control" value="<?php echo "$label"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" list="kategori_list" class="form-control" value="<?php echo "$kategori"; ?>">
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
<?php } ?>