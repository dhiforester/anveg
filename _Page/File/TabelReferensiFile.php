<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM file_referensi"));
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      <small>Belum Ada Referensi File</small>';
        echo '  </div>';
        echo '</div>';
    }else{
?>
<div class="row mb-3 border-1 border-bottom">
    <div class="col-md-12 text-center">
        <b>List Referensi Tipe File</b>
    </div>
</div>
<?php
    $no = 1;
    //KONDISI PENGATURAN MASING FILTER
    $query = mysqli_query($Conn, "SELECT*FROM file_referensi");
    while ($data = mysqli_fetch_array($query)) {
        $id_file_referensi= $data['id_file_referensi'];
        $tipe_file= $data['tipe_file'];
        $extensi_file= $data['extensi_file'];
        $support_file= $data['support_file'];
        $maksimum_upload= $data['maksimum_upload'];
        $maksimum_upload=$maksimum_upload/1000000;
?>
    <div class="row mb-3 border-1 border-bottom">
        <div class="col-md-12 mb-2">
            
            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo "$no. $tipe_file ($extensi_file)"; ?> <i class="bi bi-three-dots"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                <li class="dropdown-header text-start">
                    <h6>Option</h6>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ModalEditReferensiFile" data-id="<?php echo "$id_file_referensi"; ?>">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a> 
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalHapusReferensiFile" data-id="<?php echo "$id_file_referensi"; ?>">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-12 mb-2">
            <ul>
                <li>
                    <small>
                        Support: <code><?php echo "$support_file"; ?></code>
                    </small>
                </li>
                <li>
                    <small>
                        Max/Upload: <code><?php echo "$maksimum_upload Mb"; ?></code>
                    </small>
                </li>
            </ul>
        </div>
    </div>
<?php $no++;}} ?>
