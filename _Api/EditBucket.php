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
                    if(empty($PostData['nama'])){
                        $response = Array (
                            "message" => "Nama Bucket Tidak Boleh Kosong",
                            "code" => 404,
                        );
                        $metadata="";
                    }else{
                        if(empty($PostData['deskripsi'])){
                            $response = Array (
                                "message" => "Deskripsi Bucket Tidak Boleh Kosong",
                                "code" => 404,
                            );
                            $metadata="";
                        }else{
                            if(empty($PostData['maksimal'])){
                                $response = Array (
                                    "message" => "Maksimal File Bucket Tidak Boleh Kosong",
                                    "code" => 404,
                                );
                                $metadata="";
                            }else{
                                if(empty($PostData['id_bucket'])){
                                    $response = Array (
                                        "message" => "ID Bucket Tidak Boleh Kosong",
                                        "code" => 404,
                                    );
                                    $metadata="";
                                }else{
                                    $id_bucket=$PostData['id_bucket'];
                                    $nama=$PostData['nama'];
                                    $deskripsi=$PostData['deskripsi'];
                                    $maksimal=$PostData['maksimal'];
                                    //Lihat Data Lama
                                    $NamaLama=getDataDetail($Conn,'bucket','id_bucket',$id_bucket,'nama');
                                    if($NamaLama==$nama){
                                        $ValidasiNamaBucket=0;
                                    }else{
                                        $ValidasiNamaBucket=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM bucket WHERE id_akses='$id_akses' AND id_api_key='$id_api_key' AND nama='$nama'"));
                                    }
                                    // $maksimal=$maksimal*1000000;
                                    //Validasi Jumlah Karakter
                                    $KarakterNama=strlen($nama);
                                    $KarakterDeskripsi=strlen($deskripsi);
                                    if($KarakterNama>50){
                                        $ValidasiBucket="Nama Bucket Tidak Lebih Dari 50 Karakter";
                                    }else{
                                        if($KarakterDeskripsi>100){
                                            $ValidasiBucket="Deskripsi Bucket Tidak Lebih Dari 100 Karakter";
                                        }else{
                                            if(!preg_match("/^[0-9]*$/", $maksimal)){
                                                $ValidasiBucket="Nilai maksimum file hanya boleh angka";
                                            }else{
                                                if(validasiInput($nama)!=="Success"){
                                                    $ValidasiBucket="Nama Bucket Hanya Boleh Diisi Dengan Angka, Huruf dan Spasi";
                                                }else{
                                                    if(validasiInput($deskripsi)!=="Success"){
                                                        $ValidasiBucket="Deskripsi Bucket Hanya Boleh Diisi Dengan Angka, Huruf dan Spasi";
                                                    }else{
                                                        $ValidasiBucket="Valid";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if($ValidasiBucket!=="Valid"){
                                        $response = Array (
                                            "message" => "$ValidasiBucket",
                                            "code" => 404,
                                        );
                                        $metadata="";
                                    }else{
                                        //Validasi Nama Bucket
                                        if(!empty($ValidasiNamaBucket)){
                                            $response = Array (
                                                "message" => "Nama Bucket Tersebut Sudah Ada",
                                                "code" => 404,
                                            );
                                            $metadata="";
                                        }else{
                                            $UpdateBucket = mysqli_query($Conn,"UPDATE bucket SET 
                                                id_akses='$id_akses',
                                                id_api_key='$id_api_key',
                                                nama='$nama',
                                                deskripsi='$deskripsi',
                                                maksimal='$maksimal'
                                            WHERE id_bucket='$id_bucket'") or die(mysqli_error($Conn)); 
                                            if($UpdateBucket){
                                                $SimpanLog=AddLog($Conn,$id_akses,"$id_api_key","API","Edit Bucket");
                                                if($SimpanLog=="Success"){
                                                    $response = Array (
                                                        "message" => "Success",
                                                        "code" => 200,
                                                    );
                                                    $metadata = Array (
                                                        "nama" => "$nama",
                                                        "deskripsi" => "$deskripsi",
                                                        "maksimal" => "$maksimal"
                                                    );
                                                }else{
                                                    $response = Array (
                                                        "message" => "$SimpanLog",
                                                        "code" => 500,
                                                    );
                                                    $metadata="";
                                                }
                                            }else{
                                                $response = Array (
                                                    "message" => "Terjadi Kesalahan Pada Saat Menyimpan Data Ke Database",
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