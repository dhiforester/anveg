<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_file_referensi
    if(empty($_POST['id_file_referensi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID Bucket Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_referensi=$_POST['id_file_referensi'];
        $support_file=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'support_file');
        $tipe_file=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'tipe_file');
        $extensi_file=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'extensi_file');
        $maksimum_upload=getDataDetail($Conn,'file_referensi','id_file_referensi',$id_file_referensi,'maksimum_upload');
?>
    <input type="hidden" name="id_file_referensi" value="<?php echo "$id_file_referensi"; ?>">
    <div class="col-md-12 mb-3">
        <label for="support_file"><b>Support File</b></label>
        <select name="support_file" id="support_file" class="form-control">
            <option <?php if($support_file==""){echo "selected";} ?> value="">Pilih</option>
            <option <?php if($support_file=="vidio"){echo "selected";} ?> value="vidio">Vidio</option>
            <option <?php if($support_file=="audio"){echo "selected";} ?> value="audio">Audio</option>
            <option <?php if($support_file=="image"){echo "selected";} ?> value="image">Image</option>
            <option <?php if($support_file=="document"){echo "selected";} ?> value="document">Document</option>
        </select>
    </div>
    <div class="col-md-12 mb-3">
        <label for="tipe_file"><b>Tipe File</b></label>
        <input type="text" name="tipe_file" id="tipe_file" class="form-control" placeholder="ex: image/jpg" value="<?php echo "$tipe_file"; ?>">
    </div>
    <div class="col-md-12 mb-3">
        <label for="extensi_file"><b>Extensi File</b></label>
        <input type="text" name="extensi_file" id="extensi_file" class="form-control" placeholder="ex: .jpg" value="<?php echo "$extensi_file"; ?>">
    </div>
    <div class="col-md-12 mb-3">
        <label for="maksimum_upload"><b>Maksimum Per Upload</b></label>
        <select name="maksimum_upload" id="maksimum_upload" class="form-control">
            <option <?php if($maksimum_upload==""){echo "selected";} ?> value="">Pilih</option>
            <option <?php if($maksimum_upload=="1000000"){echo "selected";} ?> value="1000000">1 Mb</option>
            <option <?php if($maksimum_upload=="2000000"){echo "selected";} ?> value="2000000">2 Mb</option>
            <option <?php if($maksimum_upload=="5000000"){echo "selected";} ?> value="5000000">5 Mb</option>
            <option <?php if($maksimum_upload=="10000000"){echo "selected";} ?> value="10000000">10 Mb</option>
        </select>
    </div>
<?php } ?>