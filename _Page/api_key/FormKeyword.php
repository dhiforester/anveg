<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
        echo '<small>Keyword</small>';
    }else{
        $KeywordBy=$_POST['keyword_by'];
        if($KeywordBy=="id_akses"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option>Pilih</option>';
            //Arraykan Data Status Akses
            $query = mysqli_query($Conn, "SELECT DISTINCT id_akses FROM api_key");
            while ($data = mysqli_fetch_array($query)) {
                if(!empty($data['id_akses'])){
                    $id_akses= $data['id_akses'];
                    $NamaUser=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
                    $JumlahApiKey = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE id_akses='$id_akses'"));
                    echo '  <option value="'.$id_akses.'">'.$NamaUser.' ('.$JumlahApiKey.')</option>';
                }
            }
            echo '</select>';
            echo '<label for="FilterKeyword">Kata Kunci</label>';
        }else{
            if($KeywordBy=="tanggal"){
                echo '<input type="date" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
                echo '<small>Keyword</small>';
            }else{
                echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
                echo '<small>Keyword</small>';
            }
        }
    }
?>