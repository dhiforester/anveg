<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //Keyword_by
    if(!empty($_POST['keyword_by'])){
        $keyword_by=$_POST['keyword_by'];
    }else{
        $keyword_by="";
    }
    //keyword
    if(!empty($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
    //batas
    if(!empty($_POST['batas'])){
        $batas=$_POST['batas'];
    }else{
        $batas="10";
    }
    //ShortBy
    if(!empty($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="DESC";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="id_file_list";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if(empty($keyword_by)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE nama like '%$keyword%' OR label like '%$keyword%' OR kategori like '%$keyword%' OR tipe_file like '%$keyword%' OR tanggal"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE $keyword_by like '%$keyword%'"));
        }
    }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/File/TabelFile.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelFile').html(data);
                $('#PutPage').val(valueNext);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/File/TabelFile.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelFile').html(data);
                $('#PutPage').val(ValuePrev);
            }
        })
    });
    <?php 
        $JmlHalaman =ceil($jml_data/$batas); 
        $a=1;
        $b=$JmlHalaman;
        for ( $i =$a; $i<=$b; $i++ ){
    ?>
        //ketika klik page number
        $('#PageNumber<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i;?>').val();
            var batas="<?php echo "$batas"; ?>";
            var keyword="<?php echo "$keyword"; ?>";
            var keyword_by="<?php echo "$keyword_by"; ?>";
            var OrderBy="<?php echo "$OrderBy"; ?>";
            var ShortBy="<?php echo "$ShortBy"; ?>";
            $.ajax({
                url     : "_Page/File/TabelFile.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelFile').html(data);
                    $('#PutPage').val(PageNumber);
                }
            })
        });
    <?php } ?>
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-danger text-center">';
        echo '              Tidak Ada File yang Ditampilkan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM file_list ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM file_list WHERE nama like '%$keyword%' OR label like '%$keyword%' OR kategori like '%$keyword%' OR tipe_file like '%$keyword%' OR tanggal like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM file_list ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM file_list WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_file_list= $data['id_file_list'];
            $id_akses= $data['id_akses'];
            $id_api_key= $data['id_api_key'];
            $id_bucket= $data['id_bucket'];
            $nama= $data['nama'];
            $label= $data['label'];
            $kategori= $data['kategori'];
            $tipe_file= $data['tipe_file'];
            $ukuran= $data['ukuran'];
            $tanggal= $data['tanggal'];
            $file_token= $data['file_token'];
            $tanggal=FormatDateTime('d/m/Y H:i:s',$tanggal);
            //Tipe file
            $support_file=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'support_file');
            $email=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
            $api_key=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
            $Bucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
            if($support_file=="image"){
                $gambar="storage/$nama";
            }else{
                if($support_file=="audio"){
                    $gambar="assets/img/audio.png";
                }else{
                    if($support_file=="vidio"){
                        $gambar="assets/img/vidio.png";
                    }else{
                        if($support_file=="document"){
                            $gambar="assets/img/document.png";
                        }else{
                            $gambar="assets/img/file_none.png";
                        }
                    }
                }
            }
            //Buka Properti lain
            $ukuran=formatFileSize($ukuran);
?>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailFile" data-id="<?php echo "$id_file_list";?>">
                        <b><?php echo "$no. $label";?></b>
                    </a>
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                            <li class="dropdown-header text-start">
                                <h6>Option</h6>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ModalDetailFile" data-id="<?php echo "$id_file_list"; ?>">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ModalEditFile" data-id="<?php echo "$id_file_list"; ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a> 
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalHapusFile" data-id="<?php echo "$id_file_list"; ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <img src="<?php echo "$gambar"; ?>" alt="" width="100px" height="100px" class="rounded-circle">
                        </div>
                        <div class="col-md-5">
                            <small>
                                <i class="bi bi-folder"></i> <code class="text-secondary"><?php echo "$ukuran"; ?></code><br>
                                <i class="bi bi-tag"></i> <code class="text-secondary"><?php echo "$kategori"; ?></code><br>
                                <i class="bi bi-file-check"></i> <code class="text-secondary"><?php echo "$tipe_file"; ?></code><br>
                                <i class="bi bi-file"></i> <code class="text-secondary"><?php echo "$tanggal"; ?></code>
                            </small>
                        </div>
                        <div class="col-md-5">
                            <small>
                                <i class="bi bi-person-circle"></i> <code class="text-secondary"><?php echo "$email"; ?></code><br>
                                <i class="bi bi-key"></i> <code class="text-secondary"><?php echo "$api_key"; ?></code><br>
                                <i class="bi bi-bucket"></i> <code class="text-secondary"><?php echo "$Bucket"; ?></code><br>
                                <i class="bi bi-link"></i> 
                                <code class="text-info">
                                    <a href="<?php echo "File/index.php?file=$file_token"; ?>" target="_blank">
                                        <?php echo "File/index.php?file=$file_token"; ?>
                                    </a>
                                </code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $no++; } ?>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <?php
                //Mengatur Halaman
                $JmlHalaman = ceil($jml_data/$batas); 
                $JmlHalaman_real = ceil($jml_data/$batas); 
                $prev=$page-1;
                $next=$page+1;
                if($next>$JmlHalaman){
                    $next=$page;
                }else{
                    $next=$page+1;
                }
                if($prev<"1"){
                    $prev="1";
                }else{
                    $prev=$page-1;
                }
            ?>
            <button class="btn btn-sm btn-outline-info" id="PrevPage" value="<?php echo $prev;?>">
                <span aria-hidden="true">«</span>
            </button>
            <?php 
                //Navigasi nomor
                if($JmlHalaman>3){
                    if($page>=2){
                        $a=$page-1;
                        $b=$page+1;
                        if($JmlHalaman<=$b){
                            $a=$page-1;
                            $b=$JmlHalaman;
                        }
                    }else{
                        $a=1;
                        $b=$page+1;
                        if($JmlHalaman<=$b){
                            $a=1;
                            $b=$JmlHalaman;
                        }
                    }
                }else{
                    $a=1;
                    $b=$JmlHalaman;
                }
                for ( $i =$a; $i<=$b; $i++ ){
                    if($page=="$i"){
                        echo '<button class="btn btn-sm btn-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }else{
                        echo '<button class="btn btn-sm btn-outline-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }
                }
            ?>
            <button class="btn btn-sm btn-outline-info" id="NextPage" value="<?php echo $next;?>">
                <span aria-hidden="true">»</span>
            </button>
        </div>
    </div>
</div>
<?php } ?>