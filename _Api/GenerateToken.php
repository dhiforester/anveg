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
        //Tangkap Data Post
		$fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		//Decode data json
		$PostData = json_decode($raw,true);
        //Apabila Email Kosong
        if(empty($PostData['email'])){
            $response = Array (
                "message" => "Email Tidak Boleh Kosong",
                "code" => 401,
            );
            $metadata="";
        }else{
            //Password Tidak Boleh Kosong
            if(empty($PostData['password'])){
                $response = Array (
                    "message" => "Password Tidak Boleh Kosong",
                    "code" => 401,
                );
                $metadata="";
            }else{
                //api_key Tidak Boleh Kosong
                if(empty($PostData['api_key'])){
                    $response = Array (
                        "message" => "API Key Tidak Boleh Kosong",
                        "code" => 401,
                    );
                    $metadata="";
                }else{
                    $email=$PostData['email'];
                    $password=$PostData['password'];
                    $api_key=$PostData['api_key'];
                    $password=md5($password);
                    //Cek Validasi Akses
                    $Qry=mysqli_query($Conn,"SELECT*FROM akses WHERE email='$email' AND password='$password'")or die(mysqli_error($Conn));
                    $DataAkses = mysqli_fetch_array($Qry);
                    if(empty($DataAkses["id_akses"])){
                        //Apabila Akses Tidak Ditemukan
                        $response = Array (
                            "message" => "Email Dan Password Yang Digunakan Tidak Valid",
                            "code" => 400,
                        );
                        $metadata="";
                    }else{
                        $id_akses=$DataAkses["id_akses"];
                        //Validasi Api Key
                        $IdAksesApiKey=getDataDetail($Conn,'api_key','api_key',$api_key,'id_akses');
                        if($id_akses!==$IdAksesApiKey){
                            //Apabila Api Key Tidak Valid
                            $response = Array (
                                "message" => "API Key Yang Digunakan Tidak Valid",
                                "code" => 400,
                            );
                            $metadata="";
                        }else{
                            //Membuat Token Yang Berlaku Selama 1 Jam
                            $token=generateRandomString('16');
                            $expired=date('Y-m-d H:i:s', strtotime($tanggal . ' +1 hour'));
                            $id_api_key=getDataDetail($Conn,'api_key','api_key',$api_key,'id_api_key');
                            $SaveToken=SaveToken($Conn,$id_akses,$id_api_key,$token,$expired);
                            if($SaveToken!=="Success"){
                                $response = Array (
                                    "message" => "$SaveToken",
                                    "code" => 500,
                                );
                                $metadata="";
                            }else{
                                //Simpan Log
                                $AddLog=AddLog($Conn,$id_akses,$id_api_key,'API','Generate Token');
                                if($AddLog!=="Success"){
                                    $response = Array (
                                        "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log",
                                        "code" => 500,
                                    );
                                    $metadata="";
                                }else{
                                    $response = Array (
                                        "message" => "Success",
                                        "code" => 200,
                                    );
                                    $metadata = Array (
                                        "token" => "$token",
                                        "expired" => "$expired"
                                    );
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