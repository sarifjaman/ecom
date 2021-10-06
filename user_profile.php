<?php
session_start();
include("admin/class/adminBack.php");
$obj = new adminBack();
$ctg = $obj->p_display_category();
$ctgDatas = array();
while ($data = mysqli_fetch_assoc($ctg)) {
    $ctgDatas[] = $data;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

if ($user_id == null) {
    header("location:user_login.php");
}

if (isset($_GET['logoutuser'])) {
    if ($_GET['logoutuser'] == 'logout') {
        $obj->user_logout();
    }
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
        <div class="container">
            <h2 class="text-center">User Profile</h2>
            <div class="user-info">
                <div class="user-details">
                    <h3>Hello <?php if (isset($user_name)) {
                                    echo strtoupper($user_name);
                                } ?></h3>
                    <a href="?logoutuser=logout">Logout</a>
                </div>

                <div class="history">
                    <div class="shopping-cart-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title">Order History</h3>
                                <form class="shopping-cart-form" action="" method="post">
                                    <table class="shop_table cart-form">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product Name</th>
                                                <th class="product-price">Total Paid</th>
                                                <th class="product-quantity">Order Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-thumbnail" data-title="Product Name">
                                                    <a class="prd-thumb" href="#">
                                                        <figure><img width="113" height="113" src="assets/images/shippingcart/pr-01.jpg" alt="shipping cart"></figure>
                                                    </a>
                                                    <a class="prd-name" href="#">National Fresh Fruit</a>

                                                </td>

                                                <td class="product-price" data-title="Price">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>

                                                    </div>
                                                </td>


                                                <td class="product-subtotal" data-title="Total">
                                                    Pending
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </form>
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