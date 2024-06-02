<?php 
    //Universal JS
    echo '<script type="text/javascript" src="_Partial/Universal.js"></script>';
    //Routing JS
    if(empty($_GET['Page'])){
        echo '<script type="text/javascript" src="_Page/Dashboard/Dashboard.js"></script>';
    }else{
        if($_GET['Page']=="Akses"){
            echo '<script type="text/javascript" src="_Page/Akses/Akses.js"></script>';
        }else{
            if($Page=="MyProfile"){
                echo '<script type="text/javascript" src="_Page/MyProfile/MyProfile.js"></script>';
            }else{
                if($Page=="Help"){
                    echo '<script type="text/javascript" src="_Page/Help/Help.js"></script>';
                }else{
                    if($Page=="Log"){
                        echo '<script type="text/javascript" src="_Page/Log/Log.js"></script>';
                    }else{
                        if($Page=="SurveyCustomer"){
                            echo '<script type="text/javascript" src="_Page/SurveyCustomer/SurveyCustomer.js"></script>';
                        }else{
                            if($Page=="Bucket"){
                                echo '<script type="text/javascript" src="_Page/Bucket/Bucket.js"></script>';
                            }else{
                                if($Page=="File"){
                                    echo '<script type="text/javascript" src="_Page/File/File.js"></script>';
                                }else{
                                    
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    //default Login
    echo '<script type="text/javascript" src="_Page/Login/Login.js"></script>';
?>