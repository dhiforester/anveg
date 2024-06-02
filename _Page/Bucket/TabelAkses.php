<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    date_default_timezone_set("Asia/Jakarta");
    //KeywordAkses
    if(!empty($_POST['KeywordAkses'])){
        $keyword=$_POST['KeywordAkses'];
    }else{
        $keyword="";
    }
    //batas
    $batas="5";
    //ShortBy
    $ShortBy="DESC";
    //OrderBy
    $OrderBy="nama";
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akses"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akses WHERE nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR akses like '%$keyword%'"));
    }
?>
<script>
    //ketika klik next
    $('#NextPage2').click(function() {
        var valueNext2=$('#NextPage2').val();
        var keyword="<?php echo "$keyword"; ?>";
        $.ajax({
            url     : "_Page/Bucket/TabelAkses.php",
            method  : "POST",
            data 	:  { page: valueNext2, KeywordAkses: keyword },
            success: function (data) {
                $('#MenampilkanTabelAkses').html(data);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage2').click(function() {
        var ValuePrev2 = $('#PrevPage2').val();
        var keyword="<?php echo "$keyword"; ?>";
        $.ajax({
            url     : "_Page/Bucket/TabelAkses.php",
            method  : "POST",
            data 	:  { page: ValuePrev2, KeywordAkses: keyword },
            success : function (data) {
                $('#MenampilkanTabelAkses').html(data);
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
        $('#PageNumber2<?php echo $i;?>').click(function() {
            var PageNumber2 = $('#PageNumber2<?php echo $i;?>').val();
            var keyword="<?php echo "$keyword"; ?>";
            $.ajax({
                url     : "_Page/Bucket/TabelAkses.php",
                method  : "POST",
                data 	:  { page: PageNumber2, KeywordAkses: keyword},
                success: function (data) {
                    $('#MenampilkanTabelAkses').html(data);
                }
            })
        });
    <?php } ?>
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Tidak Ada Data Akun User Yang Ditampilkan';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword)){
            $query = mysqli_query($Conn, "SELECT*FROM akses WHERE akses!='Pelanggan' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
        }else{
            $query = mysqli_query($Conn, "SELECT*FROM akses WHERE akses!='Pelanggan' AND (nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR akses like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_akses= $data['id_akses'];
            $nama= $data['nama'];
            $kontak= $data['kontak'];
            $email= $data['email'];
            $akses= $data['akses'];
            //Foto
            if(empty($data['foto'])){
                $gambar="No-Image.png";
            }else{
                $gambar=$data['foto'];
            }
            //Routing Akses
            if($akses=="Customer"){
                $LabelAkses='<label class="badge badge-primary">Customer</label>';
            }else{
                $LabelAkses='<label class="badge badge-danger">Admin</label>';
            }
            //Menghitung Jumlah 
            //API Key
            $JumlahApiKey = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE id_akses='$id_akses'"));
            //File
            $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_akses='$id_akses'"));
            //Bucket
            $JumlahBucket = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_akses='$id_akses'"));
?>
    <div class="row mb-3 border-1 border-bottom">
        <div class="col-md-4 text-center mb-2">
            <img src="assets/img/User/<?php echo "$gambar"; ?>" alt="" width="100px" height="100px" class="rounded-circle">
        </div>
        <div class="col-md-8 mb-2">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalPilihApiKey" data-id="<?php echo "$id_akses";?>">
                <b><?php echo "$no. $nama";?></b>
            </a>
            <ul>
                <li>
                    <small>
                        Email : <code class="text-secondary"><?php echo "$email"; ?></code>
                    </small>
                </li>
                <li>
                    <small>
                        Akses : <code class="text-secondary"><?php echo "$LabelAkses"; ?></code>
                    </small>
                </li>
            </ul>
        </div>
    </div>
<?php $no++; }} ?>
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
            <button class="btn btn-sm btn-outline-info" id="PrevPage2" value="<?php echo $prev;?>">
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
                        echo '<button class="btn btn-sm btn-info" id="PageNumber2'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }else{
                        echo '<button class="btn btn-sm btn-outline-info" id="PageNumber2'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }
                }
            ?>
            <button class="btn btn-sm btn-outline-info" id="NextPage2" value="<?php echo $next;?>">
                <span aria-hidden="true">»</span>
            </button>
        </div>
    </div>
</div>