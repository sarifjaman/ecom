<?php
$obj_adminback = new adminBack();
$dis_cat = $obj_adminback->display_category();
?>

<h2>Manage Category</h2><br>

<?php
if ($count = mysqli_num_rows($dis_cat)) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Ctg ID</th>";
    echo "<th>Category</th>";
    echo "<th>Category Description</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";

    $sn = 1;

    while ($rows = mysqli_fetch_assoc($dis_cat)) {
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $sn++ . "</td>";
        echo "<td>" . $rows['ctg_name'] . "</td>";
        echo "<td>" . $rows['ctg_des'] . "</td>";

        echo "<td>
        <a href='' class='btn btn-success'>Update</a>
        <a href='' class='btn btn-danger'>Delete</a>
        </td>";

        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
} else {
    echo "<p>0 records!</p>";
}
?>