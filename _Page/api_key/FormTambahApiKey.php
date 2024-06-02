<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Akses Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        if(empty($DataDetailAkses['id_akses'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Akses Yang Anda Pilih Tidak Valid, Atau Tidak Ada Pada Database!';
            echo '  </div>';
            echo '</div>';
        }else{
            $nama= $DataDetailAkses['nama'];
?>
    <script>
        //Generate Api Key
        $('#GenerateApiKey').click(function(){
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/api_key/GenerateApiKey.php',
                success     : function(data){
                    $('#api_key').val(data);
                }
            });
        });
    </script>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama_akses"><b>Nama Akses</b></label> 
            <input type="text" readonly name="nama_akses" id="nama_akses" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama"><b>Nama API Key</b></label>
            <input type="text" name="nama" id="nama" class="form-control">
            <small>Maksimal 50 Karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="deskripsi"><b>Deskripsi</b></label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            <small>Maksimal 200 Karakter</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="api_key"><b>API Key</b></label>
            <div class="input-group">
                <input type="text" name="api_key" id="api_key" class="form-control">
                <button type="button" class="btn btn-sm btn-dark" id="GenerateApiKey">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </div>
            <small>Silahkan Generate Api Key</small>
        </div>
    </div>
<?php }} ?>