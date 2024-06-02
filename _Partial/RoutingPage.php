<?php
    if(empty($_GET['Page'])){
        include "_Page/Dashboard/Dashboard.php";
    }else{
        $Page=$_GET['Page'];
        if($Page=="Akses"){
            include "_Page/Akses/Akses.php";
        }else{
            if($Page=="MyProfile"){
                include "_Page/MyProfile/MyProfile.php";
            }else{
                if($Page=="Help"){
                    include "_Page/Help/Help.php";
                }else{
                    if($Page=="Log"){
                        include "_Page/Log/Log.php";
                    }else{
                        if($Page=="SurveyCustomer"){
                            include "_Page/SurveyCustomer/SurveyCustomer.php";
                        }else{
                            if($Page=="Bucket"){
                                include "_Page/Bucket/Bucket.php";
                            }else{
                                if($Page=="File"){
                                    include "_Page/File/File.php";
                                }else{
                                    if($Page=="Chating"){
                                        include "_Page/Chating/Chating.php";
                                    }else{
                                        if($Page=="Diskon"){
                                            include "_Page/Diskon/Diskon.php";
                                        }else{
                                            if($Page=="Ongkir"){
                                                include "_Page/Ongkir/Ongkir.php";
                                            }else{
                                                if($Page=="Testimoni"){
                                                    include "_Page/Testimoni/Testimoni.php";
                                                }else{
                                                    if($Page=="Rating"){
                                                        include "_Page/Rating/Rating.php";
                                                    }else{
                                                        if($Page=="Laporan"){
                                                            include "_Page/Laporan/Laporan.php";
                                                        }else{
                                                            include "_Page/Dashboard/Dashboard.php";
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
?>