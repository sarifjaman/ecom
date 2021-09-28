<?php
$obj_adminback = new adminBack();
$ret_query = $obj_adminback->display_product();

if (isset($_GET['prostatus'])) {
    $get_id = $_GET['id'];
    if ($_GET['prostatus'] == 'delete') {
        $ret_msg = $obj_adminback->delete_product($get_id);
    }
}
?>

<h2>Manage Product</h2>
<br>

<?php
if (isset($ret_msg)) {
    echo $ret_msg;
}
?>

<?php
$count = mysqli_num_rows($ret_query);
if ($count > 0) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Product Name</th>";
    echo "<th>Product Price</th>";
    echo "<th>Description</th>";
    echo "<th>Category</th>";
    echo "<th>Image</th>";
    echo "<th>Status</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";

    $sn = 1;

    while ($rows = mysqli_fetch_assoc($ret_query)) {
        $id = $rows['pdt_id'];
        $image_name = $rows['pdt_image'];

        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $sn++ . "</td>";
        echo "<td>" . $rows['pdt_name'] . "</td>";
        echo "<td>" . $rows['pdt_price'] . "</td>";
        echo "<td>" . $rows['pdt_des'] . "</td>";
        echo "<td>" . $rows['ctg_name'] . "</td>";

        echo "<td>";
        if ($image_name != "") {
?>
            <img src="<?php echo 'http://localhost/ecom/'; ?>admin/upload/<?php echo $image_name; ?>" alt="" width="100" height="80" />
<?php
        } else {
            echo "<p class='err-msg'>Image not found!</p>";
        }
        echo "</td>";

        echo "<td>";
        if ($rows['pdt_status'] == 1) {
            echo "<p class='success-msg'>Published</p>";
        } else {
            echo "<p class='err-msg'>Unpublished</p>";
        }
        echo "</td>";

        echo "<td>
        <a href='edit-product.php?prostatus=edit&&id=$id' class='btn btn-primary'>Update</a>
        <a href='?prostatus=delete&&id=$id' class='btn btn-danger'>Delete</a>
        </td>";
        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
}
?>