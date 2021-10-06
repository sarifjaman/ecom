<?php include("admin/class/adminBack.php");
$obj = new adminBack();
$ctg = $obj->p_display_category();
$ctgDatas = array();
while ($data = mysqli_fetch_assoc($ctg)) {
    $ctgDatas[] = $data;
}


?>

<?php include_once("include/head.php"); ?>

<body class="biolife-body">


    <?php include_once('include/preloader.php'); ?>
    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <?php include_once("include/header_top.php"); ?>
        <?php include_once("include/header_middle.php"); ?>
        <?php include_once("include/header_bottom.php"); ?>
    </header>

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">



            <div class="container">
                <h2 class="text-center">Login Now</h2>
                <div class="page-contain category-page no-sidebar">
                    <div class="container">

                        <div class="row">

                            <!--Form Sign In-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="signin-container">
                                    <form action="#" name="frm-login" method="post">
                                        <p class="form-row">
                                            <label for="user_email">Email Address:<span class="requite">*</span></label>
                                            <input type="email" id="fid-name" name="useremail" value="" class="txt-input">
                                        </p>
                                        <p class="form-row">
                                            <label for="user_pass">Password:<span class="requite">*</span></label>
                                            <input type="password" id="fid-pass" name="user_pass" value="" class="txt-input">
                                        </p>
                                        <p class="form-row wrap-btn">
                                            <input class="btn btn-submit btn-bold" type="submit" name="user_login_btn" value="Login">
                                            <a href="user_password_recover.php" class="link-to-help">Forgot your password</a>
                                        </p>
                                    </form>
                                </div>
                            </div>

                            <!--Go to Register form-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="register-in-container">
                                    <div class="intro">
                                        <h4 class="box-title">New Customer?</h4>
                                        <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                        <ul class="lis">
                                            <li>Check out faster</li>
                                            <li>Save multiple shipping anddesses</li>
                                            <li>Access your order history</li>
                                            <li>Track new orders</li>
                                            <li>Save items to your Wishlist</li>
                                        </ul>
                                        <a href="user_registration.php" class="btn btn-bold">Create an account</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include_once("include/footer.php"); ?>

    <!--Footer For Mobile-->
    <?php include_once("include/mobile_footer.php"); ?>

    <!--mobile global block-->
    <?php include_once("include/mobile_global_block.php"); ?>



    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php include_once("include/script.php"); ?>
</body>

</html>