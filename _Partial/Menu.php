<?php
    if(empty($_GET['Page'])){
        $PageMenu="";
    }else{
        $PageMenu=$_GET['Page'];
    }
    if(empty($_GET['Sub'])){
        $SubMenu="";
    }else{
        $SubMenu=$_GET['Sub'];
    }
?>
<aside id="sidebar" class="sidebar menu_background">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu==""){echo "";}else{echo "collapsed";} ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if($SessionAkses=="Admin"){ ?>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu=="Akses"||$PageMenu=="EntitasAkses"){echo "";}else{echo "collapsed";} ?>" href="index.php?Page=Akses">
                    <i class="bi bi-person"></i>
                    <span>Akses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu!=="Log"){echo "collapsed";} ?>" href="index.php?Page=Log">
                    <i class="bi bi-bar-chart"></i>
                    <span>Log</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu!=="api_key"){echo "collapsed";} ?>" href="index.php?Page=api_key">
                    <i class="bi bi-key"></i>
                    <span>API Key</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu!=="Bucket"){echo "collapsed";} ?>" href="index.php?Page=Bucket">
                    <i class="bi bi-bucket"></i>
                    <span>Bucket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu!=="File"){echo "collapsed";} ?>" href="index.php?Page=File">
                    <i class="bi bi-disc"></i>
                    <span>File</span>
                </a>
            </li>
        <?php } ?>
        <?php if($SessionAkses=="Customer"){ ?>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu!=="SurveyCustomer"){echo "collapsed";} ?>" href="index.php?Page=SurveyCustomer">
                    <i class="bi bi-search"></i>
                    <span>Survey</span>
                </a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Help"){echo "collapsed";} ?>" href="index.php?Page=Help">
                <i class="bi bi-question-circle"></i>
                <span>Bantuan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>