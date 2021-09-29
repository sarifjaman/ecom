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
            <!--Block 01: Main Slide-->
            <?php include_once("include/slider_main.php"); ?>
            <!--Block 02: Banners-->
            <?php include_once("include/banner_slider.php"); ?>

            <!--Block 03: Product Tabs-->
            <?php include_once("include/home_related_product.php"); ?>




            <!--Block 06: Products-->
            <div class="Product-box sm-margin-top-96px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6">
                            <?php include_once("include/deals_oftheday.php"); ?>
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6">
                            <?php include_once("include/top_rated_product.php"); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--Block 07: Brands-->
            <?php include_once("include/brands.php"); ?>
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