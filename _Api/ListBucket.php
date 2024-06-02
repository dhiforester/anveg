<?php
    header('Content-Type: application/json');
    include "../_Config/Connection.php";
    include "../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:i:s');
    //Validasi Metode Pengiriman
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        $response = Array (
            "message" => "Metode Pengiriman Data Harus GET",
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
                    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bucket WHERE id_akses='$id_akses' AND id_api_key='$id_api_key'"));
                    //Apabila Data Tidak Ada
                    if(empty($jml_data)){
                        $response = Array (
                            "message" => "Data Bucket Tidak Ada",
                            "code" => 204,
                        );
                        $metadata=Array();
                    }else{
                        $SimpanLog=AddLog($Conn,$id_akses,"$id_api_key","API","List Bucket");
                        $Qry = "SELECT * FROM bucket WHERE id_akses='$id_akses' AND id_api_key='$id_api_key'";
                        $DataBucket=mysqli_query($Conn, $Qry);
                        $List = array();
                        $List["list"] = array();
                        while($x = mysqli_fetch_array($DataBucket)){
                            $h['id_bucket'] = $x["id_bucket"];
                            $h['nama'] = $x["nama"];
                            $h['deskripsi'] = $x["deskripsi"];
                            $h['maksimal'] = $x["maksimal"];
                            array_push($List["list"], $h);
                        }
                        $response = Array (
                            "message" => "Success",
                            "code" => 200,
                        );
                        $metadata=$List;
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