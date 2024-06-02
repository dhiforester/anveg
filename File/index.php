<?php
    include "../_Config/Connection.php";
    include "../_Config/Function.php";
    require_once '../vendor/autoload.php';
    // Membaca alamat IP pengguna dari header X-Forwarded-For
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_user = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_user = $_SERVER['REMOTE_ADDR'];
    }
    // Membuat objek Mobile_Detect
    use Detection\MobileDetect;
    // Instantiate the class.
    // Here you can inject your own caching system.
    $detect = new MobileDetect();
    // Set the user agent string from HTTP headers or manually.
    $detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) ...');
    // Finally, check for "mobile".
    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
    //Membaca Perangkay
    if(!empty($_GET['file'])){
        $file_token=$_GET['file'];
        $id_file_list=getDataDetail($Conn,'file_list','file_token',$file_token,'id_file_list');
        $nama=getDataDetail($Conn,'file_list','file_token',$file_token,'nama');
        $tipe_file=getDataDetail($Conn,'file_list','file_token',$file_token,'tipe_file');
        $support_file=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'support_file');
        //Simpan Log File
        $SimpanLogFile=AddLogFile($Conn,$id_file_list,$ip_user,$deviceType);
        if($SimpanLogFile=="Success"){
            //Directory File
            $url_file="../storage/$nama";
            // Baca isi file
            $fileContents = file_get_contents($url_file);
            // Ubah ke format Base64
            $base64Encoded = base64_encode($fileContents);
            //Ubah ke base64
            if($support_file=="image"){
                $dataUri = 'data:'.$tipe_file.';base64,' . $base64Encoded;
                echo '<img src="'.$dataUri.'" alt="Base64 Image">';
            }else{
                if($support_file=="vidio"){
                    $dataUri = 'data:'.$tipe_file.';base64,' . $base64Encoded;
                    echo '<video width="640" height="360" controls>';
                    echo '  <source src="'.$dataUri.'" type="'.$tipe_file.'">';
                    echo '  Your browser does not support the video tag.';
                    echo '</video>';
                }else{
                    if($support_file=="document"){
                        $dataUri = 'data:'.$tipe_file.';base64,' . $base64Encoded;
                        echo '<iframe src="'.$dataUri.'" width="100%" height="500px"></iframe>';
                    }else{
                        if($support_file=="audio"){
                            $dataUri = 'data:'.$tipe_file.';base64,' . $base64Encoded;
                            echo '<audio controls>';
                            echo '  <source src="'.$dataUri.'" type="'.$tipe_file.'">';
                            echo '  Your browser does not support the video tag.';
                            echo '</audio>';
                        }
                    }
                }
            }
        }
    }
?>