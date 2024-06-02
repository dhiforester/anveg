<?php
    echo '<div class="pagetitle">';
    //Routing Page Title
    if(empty($_GET['Page'])){
        echo '<h1><a href=""><i class="bi bi-grid"></i> Dashboard</a></h1>';
        echo '<nav>';
        echo '  <ol class="breadcrumb">';
        echo '      <li class="breadcrumb-item active">Dashboard</li>';
        echo '  </ol>';
        echo '</nav>';
    }else{
        if($_GET['Page']=="Akses"){
            echo '<h1><i class="bi bi-person"></i> Akses</h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php?Page=Akses">Akses</a></li>';
            echo '  </ol>';
            echo '</nav>';
        }else{
            if($_GET['Page']=="MyProfile"){
                echo '<h1><i class="bi bi-person-circle"></i> Profile Saya</h1>';
                echo '<nav>';
                echo '  <ol class="breadcrumb">';
                echo '      <li class="breadcrumb-item"><a href="index.php?Page=MyProfile">Profile Saya</a></li>';
                echo '  </ol>';
                echo '</nav>';
            }else{
                if($_GET['Page']=="Help"){
                    echo '<h1><i class="bi bi-person-circle"></i> Bantuan</h1>';
                    echo '<nav>';
                    echo '  <ol class="breadcrumb">';
                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=Help">Bantuan</a></li>';
                    echo '  </ol>';
                    echo '</nav>';
                }else{
                    if($_GET['Page']=="Log"){
                        echo '<h1><i class="bi bi-bar-chart"></i> Log</h1>';
                        echo '<nav>';
                        echo '  <ol class="breadcrumb">';
                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Log">Data Log</a></li>';
                        echo '  </ol>';
                        echo '</nav>';
                    }else{
                        if($_GET['Page']=="SurveyCustomer"){
                            echo '<h1><a href=""><i class="bi bi-key"></i> Survey Anveg</a></h1>';
                            echo '<nav>';
                            echo '  <ol class="breadcrumb">';
                            echo '      <li class="breadcrumb-item"><a href="index.php">Survey Anveg</a></li>';
                            echo '  </ol>';
                            echo '</nav>';
                        }else{
                            if($_GET['Page']=="Bucket"){
                                echo '<h1><i class="bi bi-bucket"></i> Bucket</h1>';
                                echo '<nav>';
                                echo '  <ol class="breadcrumb">';
                                echo '      <li class="breadcrumb-item"><a href="index.php?Page=Bucket">Bucket</a></li>';
                                echo '  </ol>';
                                echo '</nav>';
                            }else{
                                if($_GET['Page']=="File"){
                                    echo '<h1><i class="bi bi-folder"></i> File</h1>';
                                    echo '<nav>';
                                    echo '  <ol class="breadcrumb">';
                                    echo '      <li class="breadcrumb-item"><a href="index.php">File</a></li>';
                                    echo '  </ol>';
                                    echo '</nav>';
                                }else{
                                    if($_GET['Page']=="Chating"){
                                        echo '<h1><i class="bi bi-chat"></i> Inbox</h1>';
                                        echo '<nav>';
                                        echo '  <ol class="breadcrumb">';
                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                        echo '      <li class="breadcrumb-item active">Inbox</li>';
                                        echo '  </ol>';
                                        echo '</nav>';
                                    }else{
                                        if($_GET['Page']=="Diskon"){
                                            echo '<h1><i class="bi bi-gift"></i> Diskon</h1>';
                                            echo '<nav>';
                                            echo '  <ol class="breadcrumb">';
                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                            echo '      <li class="breadcrumb-item active">Diskon</li>';
                                            echo '  </ol>';
                                            echo '</nav>';
                                        }else{
                                            if($_GET['Page']=="Ongkir"){
                                                echo '<h1><i class="bi bi-map"></i> Ongkir</h1>';
                                                echo '<nav>';
                                                echo '  <ol class="breadcrumb">';
                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                echo '      <li class="breadcrumb-item active">Ongkir</li>';
                                                echo '  </ol>';
                                                echo '</nav>';
                                            }else{
                                                if($_GET['Page']=="Testimoni"){
                                                    echo '<h1><i class="bi bi-chat-dots-fill"></i> Testimoni</h1>';
                                                    echo '<nav>';
                                                    echo '  <ol class="breadcrumb">';
                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                    echo '      <li class="breadcrumb-item active">Testimoni</li>';
                                                    echo '  </ol>';
                                                    echo '</nav>';
                                                }else{
                                                    if($_GET['Page']=="Rating"){
                                                        echo '<h1><i class="bi bi-star"></i> Rating</h1>';
                                                        echo '<nav>';
                                                        echo '  <ol class="breadcrumb">';
                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                        echo '      <li class="breadcrumb-item active">Rating</li>';
                                                        echo '  </ol>';
                                                        echo '</nav>';
                                                    }else{
                                                        if($_GET['Page']=="Laporan"){
                                                            echo '<h1><i class="bi bi-printer"></i> Laporan</h1>';
                                                            echo '<nav>';
                                                            echo '  <ol class="breadcrumb">';
                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                            echo '      <li class="breadcrumb-item active">Laporan</li>';
                                                            echo '  </ol>';
                                                            echo '</nav>';
                                                        }else{
                                                            echo '<h1><i class="bi bi-emoji-angry"></i> Error</h1>';
                                                            echo '<nav>';
                                                            echo '  <ol class="breadcrumb">';
                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                            echo '      <li class="breadcrumb-item active">Error</li>';
                                                            echo '  </ol>';
                                                            echo '</nav>';
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
    echo '</div>';
?>
