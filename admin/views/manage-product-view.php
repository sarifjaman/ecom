<?php
$obj_adminback = new adminBack();
$ret_query = $obj_adminback->display_product();
?>

<h2>Manage Product</h2>
<br>

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

        echo "<td>" . $rows['pdt_status'] . "</td>";
        echo "<td>
        <a href='' class='btn btn-primary'>Update</a>
        <a href='' class='btn btn-danger'>Delete</a>
        </td>";
        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
}
?>