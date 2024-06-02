<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_bucket
    if(empty($_POST['id_bucket'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID Bucket Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_bucket=$_POST['id_bucket'];
        $id_akses=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_akses');
        $id_api_key=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'id_api_key');
        $nama=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
        $deskripsi=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'deskripsi');
        $maksimal=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'maksimal');
        //Nama Akses
        $NamaUser=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
        $Email=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
        $Kontak=getDataDetail($Conn,'akses','id_akses',$id_akses,'kontak');
        //Api Key
        $NamaApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'nama');
        $DeskripsiApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'deskripsi');
        $ApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
        $TanggalApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'tanggal');
        $TanggalApiKey=FormatDateTime('d/m/Y H:i',$TanggalApiKey);
        //File
        $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'"));
        //Konversi Maksimal
        $Maksimal=formatFileSize($maksimal);
        //Hitung Besarnya File Yang Ada
        $SumFile = mysqli_fetch_array(mysqli_query($Conn, "SELECT SUM(ukuran) AS ukuran FROM file_list  WHERE id_bucket='$id_bucket'"));
        if(!empty($SumFile['ukuran'])){
            $JumlahStorage = $SumFile['ukuran'];
            $JumlahStorage=formatFileSize($JumlahStorage);
        }else{
            $JumlahStorage=0;
            $JumlahStorage=formatFileSize($JumlahStorage);
        }
?>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <b>A. Informasi Bucket</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $nama; ?></code></small>
                </li>
                <li>
                    <small>Deskripsi : <code class="text-secondary"><?php echo $deskripsi; ?></code></small>
                </li>
                <li>
                    <small>Maksimal : <code class="text-secondary"><?php echo $Maksimal; ?></code></small>
                </li>
                <li>
                    <small>Used : <code class="text-secondary"><?php echo $JumlahStorage; ?></code></small>
                </li>
                <li>
                    <small>File Item : <code class="text-secondary"><?php echo $JumlahFile; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <b>B. Informasi User Akses</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $NamaUser; ?></code></small>
                </li>
                <li>
                    <small>Kontak : <code class="text-secondary"><?php echo $Kontak; ?></code></small>
                </li>
                <li>
                    <small>Email : <code class="text-secondary"><?php echo $Email; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <b>C. Informasi Api Key</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $NamaApiKey; ?></code></small>
                </li>
                <li>
                    <small>Deskripsi : <code class="text-secondary"><?php echo $DeskripsiApiKey; ?></code></small>
                </li>
                <li>
                    <small>API Key : <code class="text-secondary"><?php echo $ApiKey; ?></code></small>
                </li>
                <li>
                    <small>Tanggal : <code class="text-secondary"><?php echo $TanggalApiKey; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>