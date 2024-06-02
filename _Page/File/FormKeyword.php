<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
        echo '<small>Keyword</small>';
    }else{
        $KeywordBy=$_POST['keyword_by'];
        if($KeywordBy=="id_akses"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option>Pilih</option>';
            //Arraykan Data Akses
            $query = mysqli_query($Conn, "SELECT * FROM akses");
            while ($data = mysqli_fetch_array($query)) {
                $id_akses= $data['id_akses'];
                $nama= $data['nama'];
                $JumlahBucket = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_akses='$id_akses'"));
                echo '  <option value="'.$id_akses.'">'.$nama.' ('.$JumlahBucket.')</option>';
            }
            echo '</select>';
            echo '<label for="FilterKeyword">Kata Kunci</label>';
        }else{
            if($KeywordBy=="id_api_key"){
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option>Pilih</option>';
                //Arraykan Data api_key
                $query = mysqli_query($Conn, "SELECT * FROM api_key");
                while ($data = mysqli_fetch_array($query)) {
                    $id_api_key= $data['id_api_key'];
                    $nama= $data['nama'];
                    $JumlahBucket = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_api_key='$id_api_key'"));
                    echo '  <option value="'.$id_api_key.'">'.$nama.' ('.$JumlahBucket.')</option>';
                }
                echo '</select>';
                echo '<label for="FilterKeyword">Kata Kunci</label>';
            }else{
                if($KeywordBy=="id_bucket"){
                    echo '<select name="keyword" id="keyword" class="form-control">';
                    echo '  <option>Pilih</option>';
                    //Arraykan Data api_key
                    $query = mysqli_query($Conn, "SELECT * FROM bucket");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_bucket= $data['id_bucket'];
                        $NamaBucket= $data['nama'];
                        $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'"));
                        echo '  <option value="'.$id_bucket.'">'.$NamaBucket.' ('.$JumlahFile.')</option>';
                    }
                    echo '</select>';
                    echo '<label for="FilterKeyword">Kata Kunci</label>';
                }else{
                    if($KeywordBy=="tipe_file"){
                        echo '<select name="keyword" id="keyword" class="form-control">';
                        echo '  <option>Pilih</option>';
                        //Arraykan Data api_key
                        $query = mysqli_query($Conn, "SELECT DISTINCT tipe_file FROM file_list");
                        while ($data = mysqli_fetch_array($query)) {
                            $tipe_file= $data['tipe_file'];
                            $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE tipe_file='$tipe_file'"));
                            echo '  <option value="'.$tipe_file.'">'.$tipe_file.' ('.$JumlahFile.')</option>';
                        }
                        echo '</select>';
                        echo '<label for="FilterKeyword">Kata Kunci</label>';
                    }else{
                        echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
                        echo '<small>Keyword</small>';
                    }
                }
            }
        }
    }
?>