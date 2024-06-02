<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
        echo '<small>Keyword</small>';
    }else{
        $KeywordBy=$_POST['keyword_by'];
        if($KeywordBy=="akses"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option>Pilih</option>';
            //Arraykan Data Status Akses
            $query = mysqli_query($Conn, "SELECT DISTINCT akses FROM akses");
            while ($data = mysqli_fetch_array($query)) {
                if(!empty($data['akses'])){
                    $akses= $data['akses'];
                    echo '  <option value="'.$akses.'">'.$akses.'</option>';
                }
            }
            echo '</select>';
            echo '<label for="FilterKeyword">Kata Kunci</label>';
        }else{
            echo '<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Kata Kunci">';
            echo '<small>Keyword</small>';
        }
    }
?>