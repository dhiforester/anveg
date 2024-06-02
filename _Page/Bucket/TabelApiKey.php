<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //id_akses Tidak Boleh Kosong
    if(empty($_POST['id_akses'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Akses Tidak Boleh Kosong';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_POST['id_akses'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM api_key WHERE id_akses='$id_akses'"));
        if(empty($jml_data)){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Tidak Ada Data Api Key Yang Ditampilkan';
            echo '  </div>';
            echo '</div>';
        }else{
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT*FROM api_key WHERE id_akses='$id_akses'");
            while ($data = mysqli_fetch_array($query)) {
                $id_api_key= $data['id_api_key'];
                $nama= $data['nama'];
                $deskripsi= $data['deskripsi'];
                $tanggal= $data['tanggal'];
                $api_key= $data['api_key'];
                $tanggal=FormatDateTime('d/m/Y H:i',$tanggal);
?>
                <div class="row mb-3 border-1 border-bottom">
                    <div class="col-md-12 mb-2">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahBucket" data-id="<?php echo "$id_api_key";?>">
                            <b><?php echo "$no. $nama";?></b>
                        </a>
                        <ul>
                            <li>
                                <small>
                                    Deskripsi : <code class="text-secondary"><?php echo "$deskripsi"; ?></code>
                                </small>
                            </li>
                            <li>
                                <small>
                                    Tanggal : <code class="text-secondary"><?php echo "$tanggal"; ?></code>
                                </small>
                            </li>
                            <li>
                                <small>
                                    API Key : <code class="text-secondary"><?php echo "$api_key"; ?></code>
                                </small>
                            </li>
                        </ul>
                    </div>
                </div>
<?php
                $no++; 
            }
        }
    }
?>