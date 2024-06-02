<?php
    //Verifikasi App
    function VerifikasiApp($NowIs,$username_acc,$key_acc){
        if($username_acc!=="f4a3229c9c5f1bdd9c6a6791080791b7"){
            $Response="false1";
        }else{
            if($key_acc!=="9255303f8208c9a43359a3b93b692b3d"){
                $Response="false2";
            }else{
                date_default_timezone_set('Asia/Jakarta');
                $now=date('Y-m-d H:i:s');
                $now=strtotime($now);
                if($NowIs<$now){
                    $Response="false3";
                }else{
                    $Response="true";
                }
            }
        }
        return $Response;
    }
    //Memanggil Detail Data
    function getDataDetail($Conn,$NamaDb,$NamaParam,$IdParam,$Kolom){
        $QryParam = mysqli_query($Conn,"SELECT * FROM $NamaDb WHERE $NamaParam='$IdParam'")or die(mysqli_error($Conn));
        $DataParam = mysqli_fetch_array($QryParam);
        if(empty($DataParam[$Kolom])){
            $Response="";
        }else{
            $Response=$DataParam[$Kolom];
        }
        return $Response;
    }
    //Membuat Token
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $charLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return $randomString;
    }
    //Send Email
    function SendEmail($NamaTujuan,$EmailTujuan,$Subjek,$Pesan,$email_gateway,$password_gateway,$url_provider,$nama_pengirim,$port_gateway,$url_service) {
        if(empty($NamaTujuan)){
            $Response="Nama tujuan pesan tidak boleh kosong!";
        }else{
            if(empty($EmailTujuan)){
                $Response="Email tujuan pesan tidak boleh kosong!";
            }else{
                if(empty($Subjek)){
                    $Response="Subjek pesan tidak boleh kosong!";
                }else{
                    if(empty($Pesan)){
                        $Response="Isi Pesan Tidak Boleh Kosong!";
                    }else{
                        if(empty($email_gateway)){
                            $Response="Akun Email Gateway Tidak Boleh Kosong!";
                        }else{
                            if(empty($password_gateway)){
                                $Response="Password Tidak Boleh Kosong!";
                            }else{
                                if(empty($url_provider)){
                                    $Response="URL Provider Tidak Boleh Kosong!";
                                }else{
                                    if(empty($nama_pengirim)){
                                        $Response="Nama pengirim Tidak Boleh Kosong!";
                                    }else{
                                        if(empty($port_gateway)){
                                            $Response="Port Tidak Boleh Kosong!";
                                        }else{
                                            if(empty($url_service)){
                                                $Response="Url Service Tidak Boleh Kosong!";
                                            }else{
                                                //Kirim email
                                                $ch = curl_init();
                                                $headers = array(
                                                    'Content-Type: Application/JSON',          
                                                    'Accept: Application/JSON'     
                                                );
                                                $arr = array(
                                                    "subjek" => "$Subjek",
                                                    "email_asal" => "$email_gateway",
                                                    "password_email_asal" => "$password_gateway",
                                                    "url_provider" => "$url_provider",
                                                    "nama_pengirim" => "$nama_pengirim",
                                                    "email_tujuan" => "$EmailTujuan",
                                                    "nama_tujuan" => "$NamaTujuan",
                                                    "pesan" => "$Pesan",
                                                    "port" => "$port_gateway"
                                                );
                                                $json = json_encode($arr);
                                                curl_setopt($ch, CURLOPT_URL, "$url_service");
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                $content = curl_exec($ch);
                                                $err = curl_error($ch);
                                                curl_close($ch);
                                                $get =json_decode($content, true);
                                                $Response=$content;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $Response;
    }
    //Delete Data
    function DeleteData($Conn,$NamaDb,$NamaParam,$IdParam){
        $HapusData = mysqli_query($Conn, "DELETE FROM $NamaDb WHERE $NamaParam='$IdParam'") or die(mysqli_error($Conn));
        if($HapusData){
            $Response="Success";
        }else{
            $Response="Hapus Data Gagal";
        }
        return $Response;
    }
    function NamaHari($no){
        if($no==1){
            $Response="Senin";
        }else{
            if($no==2){
                $Response="Selasa";
            }else{
                if($no==3){
                    $Response="Rabu";
                }else{
                    if($no==4){
                        $Response="Kamis";
                    }else{
                        if($no==5){
                            $Response="Jumat";
                        }else{
                            if($no==6){
                                $Response="Sabtu";
                            }else{
                                if($no==7){
                                    $Response="Minggu";
                                }else{
                                    $Response="None";
                                }
                            }
                        }
                    }
                }
            }
        }
        return $Response;
    }
    //Hapus Produk
    function HapusProduk($Conn,$id_produk){
        $HapusBarang= mysqli_query($Conn, "DELETE FROM produk WHERE id_produk='$id_produk'") or die(mysqli_error($Conn));
        if($HapusBarang){
            $HapusReting= mysqli_query($Conn, "DELETE FROM reting WHERE id_produk='$id_produk'") or die(mysqli_error($Conn));
            if($HapusReting){
                $HapusDiskon= mysqli_query($Conn, "DELETE FROM diskon WHERE id_produk='$id_produk'") or die(mysqli_error($Conn));
                if($HapusDiskon){
                    $Response="Success";
                }else{
                    $Response="Terjadi Kesalahan Pada Saat Menghapus Diskon";
                }
            }else{
                $Response="Terjadi Kesalahan Pada Saat Menghapus Reting";
            }
        }else{
            $Response="Terjadi Kesalahan Pada Saat Menghapus Barang";
        }
        return $Response;
    }
    //Get Setting
    function OpenJsonFile($UrlJsonConfig,$ParameterNameSetting){
        $json_data = file_get_contents($UrlJsonConfig);
        $JsonDecode = json_decode($json_data, true);
        $Response=$JsonDecode[$ParameterNameSetting];
        return $Response;
    }
    //Get Status App
    function GetStatusApp($UrlServer,$AppId,$AppKey){
        $array = array(
            "app_id"=> "$AppId",
            "app_key"=>"$AppKey"
        );
        $json = json_encode($array);
        //Mulai CURL
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "$UrlServer");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $ambil_json =json_decode($content, true);
        return $ambil_json;
    }
    function AddLog($Conn,$id_akses,$id_api_key,$kategori,$deskripsi){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal=date('Y-m-d H:i:s');
        if(empty($id_api_key)){
            $id_api_key="0";
        }
        $qry="INSERT INTO log (
            id_akses,
            id_api_key,
            tanggal,
            kategori,
            deskripsi
        ) VALUES (
            '$id_akses',
            '$id_api_key',
            '$tanggal',
            '$kategori',
            '$deskripsi'
        )";
        $Input=mysqli_query($Conn, $qry);
        if($Input){
            $Response="Success";
        }else{
            $Response="Terjadi Kesalahan Pada Saat Menyimpan Log";
        }
        return $Response;
    }
    function AddLogFile($Conn,$id_file_list,$ip_user,$perangkat){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal=date('Y-m-d H:i:s');
        $ip_user = mysqli_real_escape_string($Conn, $ip_user);
        $perangkat = mysqli_real_escape_string($Conn, $perangkat);
        $qry="INSERT INTO log_file (
            id_file_list,
            ip_user,
            perangkat,
            tanggal
        ) VALUES (
            '$id_file_list',
            '$ip_user',
            '$perangkat',
            '$tanggal'
        )";
        $Input=mysqli_query($Conn, $qry);
        if($Input){
            $Response="Success";
        }else{
            $Response="Terjadi Kesalahan Pada Saat Menyimpan Log";
        }
        return $Response;
    }
    //Save Token
    function SaveToken($Conn,$id_akses,$id_api_key,$token,$expired){
        if(empty($id_akses)){
            $Response="ID Akses Tidak Ada Saat Menyimpan Token";
        }else{
            if(empty($id_api_key)){
                $Response="ID API Key Tidak Ada Saat Menyimpan Token";
            }else{
                if(empty($token)){
                    $Response="Token Tidak Ada Saat Menyimpan Token";
                }else{
                    if(empty($expired)){
                        $Response="Tanggal Expired Tidak Ada Saat Menyimpan Token";
                    }else{
                        //Apakah Sebelumnya Sudah Punya Token
                        $Qry = mysqli_query($Conn,"SELECT * FROM token WHERE id_akses='$id_akses' AND id_api_key='$id_api_key'")or die(mysqli_error($Conn));
                        $Data = mysqli_fetch_array($Qry);
                        if(empty($Data['id_token'])){
                            //Jika Belum Ada Buat Token Baru
                            $qry="INSERT INTO token (
                                id_akses,
                                id_api_key,
                                token,
                                expired
                            ) VALUES (
                                '$id_akses',
                                '$id_api_key',
                                '$token',
                                '$expired'
                            )";
                            $Input=mysqli_query($Conn, $qry);
                            if($Input){
                                $Response="Success";
                            }else{
                                $Response="Terjadi Kesalahan Pada Saat Menyimpan Token";
                            }
                        }else{
                            //Jika Sudah Ada Update Token
                            $id_token= $Data['id_token'];
                            $UpdateToken = mysqli_query($Conn,"UPDATE token SET 
                                token='$token',
                                expired='$expired'
                            WHERE id_token='$id_token'") or die(mysqli_error($Conn)); 
                            if($UpdateToken){
                                $Response="Success";
                            }else{
                                $Response="Terjadi Kesalahan Pada Saat Melakukan Update Token";
                            }
                        }
                    }
                }
            }
        }
        return $Response;
    }
    //Format Tanggal
    function FormatDateTime($Format,$Tanggal){
        date_default_timezone_set('Asia/Jakarta');
        $strtotime=strtotime($Tanggal);
        $Response=date($Format, $strtotime);
        return $Response;
    }
    //Validasi Input Hanya Boleh Angka Huruf dan Spasi
    function validasiInput($input) {
        // Hanya huruf, angka, dan spasi yang diperbolehkan
        $pattern = '/^[A-Za-z0-9\s]+$/';
        // Lakukan validasi
        if (preg_match($pattern, $input)) {
            $Response="Success";
        } else {
            $Response="Hanya Boleh Huruf, Angka dan Spasi";
        }
        return $Response;
    }
    function formatFileSize($sizeInBytes) {
        // Konversi ukuran file ke kilobytes, megabytes, dan gigabytes
        $sizeInKb = $sizeInBytes / 1024;
        $sizeInMb = $sizeInKb / 1024;
        $sizeInGb = $sizeInMb / 1024;
        // Tentukan format yang sesuai berdasarkan ukuran file
        if ($sizeInGb >= 1) {
            return number_format($sizeInGb, 2) . ' GB';
        } elseif ($sizeInMb >= 1) {
            return number_format($sizeInMb, 2) . ' MB';
        } elseif ($sizeInKb >= 1) {
            return number_format($sizeInKb, 2) . ' KB';
        } else {
            return $sizeInBytes . ' Bytes';
        }
    }
    // Fungsi untuk mengonversi ukuran file ke format yang lebih mudah dibaca
    function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
?>