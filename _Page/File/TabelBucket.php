<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //id_api_key Tidak Boleh Kosong
    if(empty($_POST['id_api_key'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID API Key Tidak Boleh Kosong';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_api_key=$_POST['id_api_key'];
        $id_akses=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'id_akses');
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bucket WHERE id_api_key='$id_api_key'"));
        if(empty($jml_data)){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Tidak Ada Data Api Key Yang Ditampilkan';
            echo '  </div>';
            echo '</div>';
        }else{
?>
    <div class="modal-body">
        <?php
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT*FROM bucket WHERE id_api_key='$id_api_key'");
            while ($data = mysqli_fetch_array($query)) {
                $id_bucket= $data['id_bucket'];
                $nama= $data['nama'];
                $deskripsi= $data['deskripsi'];
        ?>
            <div class="row mb-3 border-1 border-bottom">
                <div class="col-md-12 mb-2">
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahFile" data-id="<?php echo "$id_bucket";?>">
                        <b><?php echo "$no. $nama";?></b>
                    </a>
                    <ul>
                        <li>
                            <small>Deskripsi: <code><?php echo "$deskripsi"; ?></code></small>
                        </li>
                    </ul>
                </div>
            </div>
        <?php $no++; }} ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihApiKey" data-id="<?php echo "$id_akses"; ?>">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </button>
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php
    }
?>