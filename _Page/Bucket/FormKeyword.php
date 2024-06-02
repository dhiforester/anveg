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
                if($KeywordBy=="maksimal"){
                    echo '<input type="number" min="0" name="keyword" id="keyword" class="form-control" placeholder="Size">';
                    echo '<small>Keyword</small>';
                }else{
                    echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
                    echo '<small>Keyword</small>';
                }
            }
        }
    }
?>