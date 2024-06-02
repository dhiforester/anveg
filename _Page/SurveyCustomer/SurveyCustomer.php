<?php
    if(empty($_GET['Sub'])){
        include "_Page/SurveyCustomer/SurveyCustomerHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailSurvey"){
            include "_Page/SurveyCustomer/DetailSurvey.php";
        }else{
            include "_Page/SurveyCustomer/SurveyCustomerHome.php";
        }
    }
?>