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
        $Email=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
        $Kontak=getDataDetail($Conn,'akses','id_akses',$id_akses,'kontak');
        //Jumlah Aktivitas
        $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE id_api_key='$id_api_key'"));
        //File
        $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_api_key='$id_api_key'"));
        //Bucket
        $JumlahBucket = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_api_key='$id_api_key'"));
?>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <b>A. Informasi Api Key</b>
            <ul>
                <li>
                    <small>Nama API : <code class="text-secondary"><?php echo $nama; ?></code></small>
                </li>
                <li>
                    <small>Deskripsi : <code class="text-secondary"><?php echo $deskripsi; ?></code></small>
                </li>
                <li>
                    <small>API Key : <code class="text-secondary"><?php echo $api_key; ?></code></small>
                </li>
                <li>
                    <small>Tanggal Dibuat : <code class="text-secondary"><?php echo $tanggal; ?></code></small>
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
            <b>C. Riwayat Data Dan Aktivitas</b>
            <ul>
                <li>
                    <small>Aktivitas : <code class="text-secondary"><?php echo $JumlahLog; ?></code></small>
                </li>
                <li>
                    <small>Bucket : <code class="text-secondary"><?php echo $JumlahBucket; ?></code></small>
                </li>
                <li>
                    <small>Jumlah File : <code class="text-secondary"><?php echo $JumlahFile; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>