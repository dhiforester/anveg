<?php
    //Apabila User Sudah Login Maka Akan Diarahkan Ke halaman Index
    session_start();
    include "_Config/Connection.php";
    include "_Config/Function.php";
    include "_Config/SettingGeneral.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include "_Partial/JsPlugin.php";
        ?>
    </head>
    <body>
        <main class="bg bg-dark">
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-2 pb-2 text-center">
                                            <img src="assets/img/<?php echo "$favicon"; ?>" alt="logo" width="150em" class="text-center">
                                            <h5 class="card-title text-center pb-0 fs-4">Login Ke Aplikasi</h5>
                                            <p class="text-center small">Masukan Email Dan Password Untuk Melakukan Login</p>
                                        </div>
                                        <form action="javascript:void(0);" class="row g-3" id="ProsesLogin">
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="email" name="email" class="form-control" id="email" required>
                                                    <div class="invalid-feedback">Please enter your username.</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" required>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                                <small class="credit">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword2" name="TampilkanPassword2">
                                                        <label class="form-check-label" for="TampilkanPassword2">
                                                            Tampilkan Password
                                                        </label>
                                                    </div>
                                                </small>
                                            </div>
                                            <div class="col-12" >
                                                <small id="NotifikasiLogin">
                                                    Pastikan email dan password sudah benar.
                                                </small>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-dark w-100" type="submit" id="TombolLogin">
                                                    <i class="bi bi-lock"></i> Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="credits text-center">
                                    <small>
                                        <div class="copyright text-white">
                                            &copy; Copyright <strong><span><?php echo "$title_page"; ?></span></strong>. All Rights Reserved
                                        </div>
                                        <div class="credits text-white">
                                            Designed by <b class="text-warning"><?php echo "$author"; ?></b><br>
                                            <?php echo "$organization ($year)"; ?>
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
        <?php
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            include "_Partial/RoutingJs.php";
            include "_Partial/RoutingSwal.php";
        ?>
        <script>
            //Kondisi saat tampilkan password
            $('#TampilkanPassword2').click(function(){
                if($(this).is(':checked')){
                    $('#password').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                }
            });
        </script>
    </body>
</html>