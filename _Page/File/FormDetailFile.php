<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Tangkap id_file_list
    if(empty($_POST['id_file_list'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger mb-3">';
        echo '      ID File Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_list=$_POST['id_file_list'];
        $id_akses=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'id_akses');
        $id_api_key=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'id_api_key');
        $id_bucket=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'id_bucket');
        $nama=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'nama');
        $label=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'label');
        $kategori=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'kategori');
        $tipe_file=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'tipe_file');
        $ukuran=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'ukuran');
        $tanggal=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'tanggal');
        $file_token=getDataDetail($Conn,'file_list','id_file_list',$id_file_list,'file_token');
        $tanggal=FormatDateTime('d/m/Y H:i:s',$tanggal);
        $ukuran=formatFileSize($ukuran);
        //Akses
        $NamaAkses=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
        $KontakAkses=getDataDetail($Conn,'akses','id_akses',$id_akses,'kontak');
        $EmailAkses=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
        $LevelAkses=getDataDetail($Conn,'akses','id_akses',$id_akses,'akses');
        //Api Key
        $NamaApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'nama');
        $DeskripsiApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'deskripsi');
        $ApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
        $TanggalApiKey=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'tanggal');
        $TanggalApiKey=FormatDateTime('d/m/Y H:i:s',$TanggalApiKey);
        //Bucket
        $NamaBucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
        $DeskripsiBucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'deskripsi');
        $MaksimalBucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'maksimal');
        $MaksimalBucket=formatFileSize($MaksimalBucket);
?>
    <div class="row mb-3 border-1 border-bottom"> 
        <div class="col-md-12">
            <b>1. Informasi File</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $nama; ?></code></small>
                </li>
                <li>
                    <small>Label : <code class="text-secondary"><?php echo $label; ?></code></small>
                </li>
                <li>
                    <small>Kategori : <code class="text-secondary"><?php echo $kategori; ?></code></small>
                </li>
                <li>
                    <small>Tipe : <code class="text-secondary"><?php echo $tipe_file; ?></code></small>
                </li>
                <li>
                    <small>Ukuran : <code class="text-secondary"><?php echo $ukuran; ?></code></small>
                </li>
                <li>
                    <small>Tanggal : <code class="text-secondary"><?php echo $tanggal; ?></code></small>
                </li>
                <li>
                    <small>
                        URL : 
                        <code class="text-secondary">
                            <a href="<?php echo "File/index.php?file=$file_token"; ?>" target="_blank">
                                <?php echo "File/index.php?file=$file_token"; ?>
                            </a>
                        </code>
                    </small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-3 border-1 border-bottom"> 
        <div class="col-md-12">
            <b>2. Pemilik File</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $NamaAkses; ?></code></small>
                </li>
                <li>
                    <small>Kontak : <code class="text-secondary"><?php echo $KontakAkses; ?></code></small>
                </li>
                <li>
                    <small>Email : <code class="text-secondary"><?php echo $EmailAkses; ?></code></small>
                </li>
                <li>
                    <small>Level : <code class="text-secondary"><?php echo $LevelAkses; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-3 border-1 border-bottom"> 
        <div class="col-md-12">
            <b>3. Api Key</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $NamaApiKey; ?></code></small>
                </li>
                <li>
                    <small>Deskripsi : <code class="text-secondary"><?php echo $DeskripsiApiKey; ?></code></small>
                </li>
                <li>
                    <small>Api Key : <code class="text-secondary"><?php echo $ApiKey; ?></code></small>
                </li>
                <li>
                    <small>Tanggal : <code class="text-secondary"><?php echo $TanggalApiKey; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <b>4. Bucket</b>
            <ul>
                <li>
                    <small>Nama : <code class="text-secondary"><?php echo $NamaBucket; ?></code></small>
                </li>
                <li>
                    <small>Deskripsi : <code class="text-secondary"><?php echo $DeskripsiBucket; ?></code></small>
                </li>
                <li>
                    <small>Maksimal : <code class="text-secondary"><?php echo $MaksimalBucket; ?></code></small>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>