<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_api_key
    if(empty($_POST['id_api_key'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID Api Key Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_api_key=$_POST['id_api_key'];
        $id_akses=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'id_akses');
        $nama=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'nama');
        $deskripsi=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'deskripsi');
        $api_key=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
        $tanggal=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'tanggal');
        $tanggal=FormatDateTime('d/m/Y H:i',$tanggal);
        //Nama Akses
        $NamaUser=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
?>
    <script>
        //Generate Api Key
        $('#GenerateApiKey2').click(function(){
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/api_key/GenerateApiKey.php',
                success     : function(data){
                    $('#api_key2').val(data);
                }
            });
        });
    </script>
    <input type="hidden" name="id_api_key" value="<?php echo "$id_api_key"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama_akses"><b>Nama Akses</b></label> 
            <input type="text" readonly name="nama_akses" id="nama_akses" class="form-control" value="<?php echo "$NamaUser"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama"><b>Nama API Key</b></label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
            <small>Maksimal 50 Karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="deskripsi"><b>Deskripsi</b></label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo "$deskripsi"; ?></textarea>
            <small>Maksimal 200 Karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="api_key"><b>API Key</b></label>
            <div class="input-group">
                <input type="text" name="api_key" id="api_key2" class="form-control" value="<?php echo "$api_key"; ?>">
                <button type="button" class="btn btn-sm btn-dark" id="GenerateApiKey2">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </div>
            <small>Silahkan Generate Api Key</small>
        </div>
    </div>
<?php } ?>