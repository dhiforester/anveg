<?php
    header('Content-Type: application/json');
    include "../_Config/Connection.php";
    include "../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:i:s');
    //Validasi Metode Pengiriman
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $response = Array (
            "message" => "Metode Pengiriman Data Harus POST",
            "code" => 403,
        );
        $metadata="";
    }else{
        //Buka data HTTP header
		$headers= getallheaders();
		//Apakah Token Ada?
		if(empty($headers['token'])){
			$response = Array (
                "message" => "Token Tidak Boleh Kosong",
                "code" => 401,
            );
            $metadata="";
		}else{
            $token=$headers['token'];
            //Validasi Token
            $id_token=getDataDetail($Conn,'token','token',$token,'id_akses');
            if(empty($id_token)){
                $response = Array (
                    "message" => "Token Yang Digunakan ($token) Tidak Valid",
                    "code" => 403,
                );
                $metadata="";
            }else{
                $expired=getDataDetail($Conn,'token','token',$token,'expired');
                if($tanggal>$expired){
                    $response = Array (
                        "message" => "Token Yang Digunakan ($token) Sudah Expired",
                        "code" => 403,
                    );
                    $metadata="";
                }else{
                    $id_akses=getDataDetail($Conn,'token','token',$token,'id_akses');
                    $id_api_key=getDataDetail($Conn,'token','token',$token,'id_api_key');
                    $api_key=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
                    //Tangkap Data Post
                    $fp = fopen('php://input', 'r');
                    $raw = stream_get_contents($fp);
                    //Decode data json
                    $PostData = json_decode($raw,true);
                    //Apabila nama Kosong
                    if(empty($PostData['id_bucket'])){
                        $response = Array (
                            "message" => "ID Bucket Tidak Boleh Kosong",
                            "code" => 404,
                        );
                        $metadata="";
                    }else{
                        if(empty($PostData['label'])){
                            $response = Array (
                                "message" => "Label File Tidak Boleh Kosong",
                                "code" => 404,
                            );
                            $metadata="";
                        }else{
                            if(empty($PostData['kategori'])){
                                $response = Array (
                                    "message" => "Kategori File Tidak Boleh Kosong",
                                    "code" => 404,
                                );
                                $metadata="";
                            }else{
                                if(empty($PostData['tipe_file'])){
                                    $response = Array (
                                        "message" => "Tipe File Tidak Boleh Kosong",
                                        "code" => 404,
                                    );
                                    $metadata="";
                                }else{
                                    if(empty($PostData['base64'])){
                                        $response = Array (
                                            "message" => "Base64 File Tidak Boleh Kosong",
                                            "code" => 404,
                                        );
                                        $metadata="";
                                    }else{
                                        $id_bucket=$PostData['id_bucket'];
                                        $label=$PostData['label'];
                                        $kategori=$PostData['kategori'];
                                        $tipe_file=$PostData['tipe_file'];
                                        $base64=$PostData['base64'];
                                        //Validasi Extension File
                                        $extensi_file=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'extensi_file');
                                        if(empty($extensi_file)){
                                            $response = Array (
                                                "message" => "Tipe File Tidak Valid",
                                                "code" => 404,
                                            );
                                            $metadata="";
                                        }else{
                                            //Validasi Bucket
                                            $ValidasiBucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
                                            if(empty($ValidasiBucket)){
                                                $response = Array (
                                                    "message" => "ID Bucket Tidak Valid",
                                                    "code" => 404,
                                                );
                                                $metadata="";
                                            }else{
                                                //hitung ukuran file
                                                $binaryData = base64_decode($base64);
                                                $fileSize = strlen($binaryData);
                                                $maksimum_upload=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'maksimum_upload');
                                                if($maksimum_upload<$fileSize){
                                                    $response = Array (
                                                        "message" => "Ukuran File ($fileSize) Terlalu Besar (Maksimal $maksimum_upload)",
                                                        "code" => 404,
                                                    );
                                                    $metadata="";
                                                }else{
                                                    //Membuat nama file
                                                    $extensi_file=getDataDetail($Conn,'file_referensi','tipe_file',$tipe_file,'extensi_file');
                                                    $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                    $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                    $FileNameRand=$key;
                                                    $NamaFileBaru = "$FileNameRand$extensi_file";
                                                    $ValidasiLabelDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE label='$label' AND id_bucket='$id_bucket'"));
                                                    if(!empty($ValidasiLabelDuplikat)){
                                                        $response = Array (
                                                            "message" => "Label File Tersebut Sudah Ada, Gunakan Label Lain",
                                                            "code" => 404,
                                                        );
                                                        $metadata="";
                                                    }else{
                                                        $path = "../storage/".$NamaFileBaru;
                                                        if(file_put_contents($path, $binaryData)){
                                                            //Membuat File Token
                                                            $file_token=generateRandomString('16');
                                                            $entry="INSERT INTO file_list (
                                                                id_akses,
                                                                id_api_key,
                                                                id_bucket,
                                                                nama,
                                                                label,
                                                                kategori,
                                                                tipe_file,
                                                                ukuran,
                                                                tanggal,
                                                                file_token
                                                            ) VALUES (
                                                                '$id_akses',
                                                                '$id_api_key',
                                                                '$id_bucket',
                                                                '$NamaFileBaru',
                                                                '$label',
                                                                '$kategori',
                                                                '$tipe_file',
                                                                '$fileSize',
                                                                '$tanggal',
                                                                '$file_token'
                                                            )";
                                                            $Input=mysqli_query($Conn, $entry);
                                                            if($Input){
                                                                $SimpanLog=AddLog($Conn,$id_akses,"$id_api_key","API","Add File");
                                                                if($SimpanLog=="Success"){
                                                                    $response = Array (
                                                                        "message" => "Success",
                                                                        "code" => 200,
                                                                    );
                                                                    $metadata = Array (
                                                                        "id_bucket" => "$id_bucket",
                                                                        "kategori" => "$kategori",
                                                                        "label" => "$label",
                                                                        "nama" => "$NamaFileBaru",
                                                                        "ukuran" => "$fileSize",
                                                                        "maksimal" => "$maksimum_upload",
                                                                        "tanggal" => "$tanggal",
                                                                        "file_token" => "$file_token",
                                                                    );
                                                                }else{
                                                                    $response = Array (
                                                                        "message" => "Terjadi kesalahan pada saat menyimpan data Log",
                                                                        "code" => 404,
                                                                    );
                                                                    $metadata="";
                                                                }
                                                            }else{
                                                                $response = Array (
                                                                    "message" => "Terjadi kesalahan pada saat menyimpan data ke dalam database",
                                                                    "code" => 404,
                                                                );
                                                                $metadata="";
                                                            }
                                                        }else{
                                                            $response = Array (
                                                                "message" => "Terjadi kesalahan pada saat menyimpan file",
                                                                "code" => 404,
                                                            );
                                                            $metadata="";
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
                }
            }
        }
    }
    $Array = Array (
        "response" => $response,
        "metadata" => $metadata,
    );
    $json = json_encode($Array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (10 * 60)));
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header('Content-Type: application/json');
    header('Pragma: no-chache');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, x-token, token"); 
    echo $json;
    exit();
?>