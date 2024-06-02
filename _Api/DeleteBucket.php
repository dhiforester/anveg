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
                        $JumlahFile = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'"));
                        //Arraykan File
                        if(!empty($JumlahFile)){
                            $Qry = mysqli_query($Conn, "SELECT*FROM file_list WHERE id_bucket='$id_bucket'");
                            while ($Data = mysqli_fetch_array($Qry)) {
                                $id_file_list= $Data['id_file_list'];
                                $nama= $Data['nama'];
                                $FotoLama = "../../storage/".$nama;
                                unlink($FotoLama);
                                $HapusFile = mysqli_query($Conn, "DELETE FROM file_list WHERE id_file_list='$id_file_list'") or die(mysqli_error($Conn));
                            }
                        }
                        //Hapus Bucket
                        $HapusBucket = mysqli_query($Conn, "DELETE FROM bucket WHERE id_bucket='$id_bucket'") or die(mysqli_error($Conn));
                        if ($HapusBucket) {
                            $SimpanLog=AddLog($Conn,$id_akses,"$id_api_key","API","Hapus Bucket");
                            if($SimpanLog=="Success"){
                                $response = Array (
                                    "message" => "Success",
                                    "code" => 200,
                                );
                                $metadata ="";
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