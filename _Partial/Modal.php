<?php
    include "_Page/Logout/ModalLogout.php";
    if(empty($_GET['Page'])){
        $Page="";
    }else{
        $Page=$_GET['Page'];
    }
    if($Page=="Akses"){
        include "_Page/Akses/ModalAkses.php";
    }else{
        if($Page=="MyProfile"){
            include "_Page/MyProfile/ModalMyProfile.php";
        }else{
            if($Page=="Log"){
                include "_Page/Log/ModalLog.php";
            }else{
                if($Page=="SurveyCustomer"){
                    include "_Page/SurveyCustomer/ModalSurveyCustomer.php";
                }else{
                    if($Page=="Bucket"){
                        include "_Page/Bucket/ModalBucket.php";
                    }else{
                        if($Page=="File"){
                            include "_Page/File/ModalFile.php";
                        }else{
                
                        }
                    }
                }
            }
        }
    }
?>