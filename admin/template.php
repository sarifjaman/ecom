<?php
include('class/adminBack.php');
session_start();
$adminId = $_SESSION['id'];
$adminEmail = $_SESSION['adminEmail'];
if ($adminId == null) {
    header('location:index.php');
}
if (isset($_GET['adminLogout'])) {
    $obj_adminback = new adminBack();
    $obj_adminback->adminlogout();
}
?>
<?php include('includes/head.php'); ?>

<body>
    <div class="fixed-button">
        <a href="https://codedthemes.com/item/gradient-able-admin-template" target="_blank" class="btn btn-md btn-primary">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
        </a>
    </div>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?php include_once('includes/header-nav.php'); ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php include_once('includes/sidenav.php'); ?>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">


                                        <?php
                                        if ($views == TRUE) {
                                            if ($views == "dashboard") {
                                                include("views/dashboard-view.php");
                                            } elseif ($views == "add-product") {
                                                include("views/add-product-view.php");
                                            } elseif ($views == "manage-product") {
                                                include("views/manage-product-view.php");
                                            } elseif ($views == "add-category") {
                                                include("views/add-category-view.php");
                                            } elseif ($views == "manage-category") {
                                                include("views/manage-category-view.php");
                                            } elseif ($views == "edit-category") {
                                                include('views/edit-category-view.php');
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Warning Section Ends -->
    <?php include('includes/script.php'); ?>