<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
        echo '<small>Keyword</small>';
    }else{
        $KeywordBy=$_POST['keyword_by'];
        if($KeywordBy=="tanggal"){
            echo '<input type="date" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
            echo '<small>Keyword</small>';
        }else{
            if($KeywordBy=="kategori"){
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option>Pilih</option>';
                //Arraykan Data Kategori
                $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM log");
                while ($data = mysqli_fetch_array($query)) {
                    if(!empty($data['kategori'])){
                        $kategori= $data['kategori'];
                        echo '  <option value="'.$kategori.'">'.$kategori.'</option>';
                    }
                }
                echo '</select>';
                echo '<label for="FilterKeyword">Kata Kunci</label>';
            }else{
                echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
                echo '<small>Keyword</small>';
            }
        }
    }
?>