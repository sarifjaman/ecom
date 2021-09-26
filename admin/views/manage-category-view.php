<?php
$obj_adminback = new adminBack();
$dis_cat = $obj_adminback->display_category();

if (isset($_GET['status'])) {
    $get_id = $_GET['id'];
    if ($_GET['status'] == 'unpublished') {
        $obj_adminback->cat_unpublish($get_id);
    } elseif ($_GET['status'] == 'published') {
        $obj_adminback->cat_publish($get_id);
    } elseif ($_GET['status'] == 'delete') {
        $msg = $obj_adminback->cat_delete($get_id);
    }
}
?>

<h2>Manage Category</h2><br>

<?php
if (isset($msg)) {
    echo $msg;
}
?>

<?php
if ($count = mysqli_num_rows($dis_cat)) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Ctg ID</th>";
    echo "<th>Category</th>";
    echo "<th>Category Description</th>";
    echo "<th>Caregory Status</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";

    $sn = 1;

    while ($rows = mysqli_fetch_assoc($dis_cat)) {
        $id = $rows['ctg_id'];
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $sn++ . "</td>";
        echo "<td>" . $rows['ctg_name'] . "</td>";
        echo "<td>" . $rows['ctg_des'] . "</td>";

        echo "<td>";
        if ($rows['ctg_status'] == '1') {
            echo "Published";
?>
            <a href="?status=unpublished&&id=<?php echo $id; ?>" class="btn btn-danger">Unpublished</a>
        <?php
        } else {
            echo "Unpublished";
        ?>
            <a href="?status=published&&id=<?php echo $id; ?>" class="btn btn-success">Published</a>
<?php
        }
        echo "</td>";

        echo "<td>
        <a href='edit-category.php?status=edit&&id=$id' class='btn btn-success'>Update</a>
        <a href='?status=delete&&id=$id' class='btn btn-danger'>Delete</a>
        </td>";

        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
} else {
    echo "<p>0 records!</p>";
}
?>