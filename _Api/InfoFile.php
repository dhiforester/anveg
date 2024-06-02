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
                    //Apabila id_bucket Kosong
                    if(empty($PostData['id_bucket'])){
                        $response = Array (
                            "message" => "ID Bucket Tidak Boleh Kosong",
                            "code" => 404,
                        );
                        $metadata="";
                    }else{
                        $id_bucket=$PostData['id_bucket'];
                        //Lihat Data Lama
                        $ValidasiIdBucket=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
                        if(empty($ValidasiIdBucket)){
                            $response = Array (
                                "message" => "ID Bucket Tidak Ada Pada Database",
                                "code" => 404,
                            );
                            $metadata="";
                        }else{
                            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM  file_list WHERE id_bucket='$id_bucket' AND id_api_key='$id_api_key'"));
                            $SimpanLog=AddLog($Conn,$id_akses,"$id_api_key","API","Info File");
                            if($SimpanLog=="Success"){
                                $response = Array (
                                    "message" => "Success",
                                    "code" => 200,
                                );
                                $metadata = Array (
                                    "jumlah_data" => "$jml_data"
                                );
                            }else{
                                $response = Array (
                                    "message" => "$SimpanLog",
                                    "code" => 500,
                                );
                                $metadata="";
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