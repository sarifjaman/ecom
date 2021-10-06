<?php include("admin/class/adminBack.php");
$obj = new adminBack();
$ctg = $obj->p_display_category();
$ctgDatas = array();
while ($data = mysqli_fetch_assoc($ctg)) {
    $ctgDatas[] = $data;
}

if (isset($_POST['user_register_btn'])) {
    $ret_msg = $obj->user_register($_POST);
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
                <div class="page-contain category-page no-sidebar">
                    <div class="container">
                        <h2 class="text-center">Register As User</h2><br>
                        <?php
                        if (isset($ret_msg)) {
                            echo $ret_msg;
                        }
                        ?>
                        <div class="row">

                            <!--Form Sign In-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="signin-container">
                                    <form action="" name="frm-register" method="post">
                                        <p class="form-row">
                                            <label for="username">Username:<span class="requite">*</span></label>
                                            <input type="text" id="fid-name" name="username" value="" class="txt-input">
                                        </p>

                                        <p class="form-row">
                                            <label for="user_firstname">First Name:<span class="requite">*</span></label>
                                            <input type="text" id="fid-name" name="user_firstname" value="" class="txt-input">
                                        </p>

                                        <p class="form-row">
                                            <label for="user_lastname">Last Name:<span class="requite">*</span></label>
                                            <input type="text" id="fid-name" name="user_lastname" value="" class="txt-input">
                                        </p>

                                        <p class="form-row">
                                            <label for="user_email">Email Address:<span class="requite">*</span></label>
                                            <input type="email" id="fid-name" name="useremail" value="" class="txt-input">
                                        </p>

                                        <p class="form-row">
                                            <label for="user_phone_number">Phone Number:<span class="requite">*</span></label>
                                            <input type="number" id="fid-name" name="phonenumber" value="" class="txt-input">
                                        </p>

                                        <p class="form-row">
                                            <label for="user_pass">Password:<span class="requite">*</span></label>
                                            <input type="password" id="fid-pass" name="user_pass" value="" class="txt-input">
                                        </p>

                                        <input type="hidden" name="user_rules" value="5">

                                        <p class="form-row wrap-btn">
                                            <input type="submit" name="user_register_btn" class="btn btn-submit btn-bold" value="Register">

                                        </p>
                                    </form>
                                </div>
                            </div>

                            <!--Go to Register form-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="register-in-container">
                                    <div class="intro">
                                        <h4 class="box-title">Already registered?</h4>
                                        <p class="sub-title">Login to access your profile :</p>
                                        <ul class="lis">
                                            <li>Check out faster</li>
                                            <li>Save multiple shipping anddesses</li>
                                            <li>Access your order history</li>
                                            <li>Track new orders</li>
                                            <li>Save items to your Wishlist</li>
                                        </ul>
                                        <a href="user_login.php" class="btn btn-bold">Login To Your Account</a>
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