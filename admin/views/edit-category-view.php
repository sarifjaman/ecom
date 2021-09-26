<?php
$obj_adminback = new adminBack();

if (isset($_GET['status'])) {
    $get_id = $_GET['id'];
    if ($_GET['status'] == 'edit') {
        $get_rows = $obj_adminback->BupdatePageShow($get_id);
    }
}

if (isset($_POST['update_cat_btn'])) {
    $ret_msg = $obj_adminback->updateCategory($_POST);
}
?>
<h2>Update category</h2>
<br>
<?php
if (isset($ret_msg)) {
    echo $ret_msg;
}
?>

<form action="" method="post">
    <div class="form-group">
        <input hidden type="text" class="form-control" name="up_ctg_id" value="<?php echo $get_rows['ctg_id']; ?>">
    </div>

    <div class="form-group">
        <label for="ctg-name">Category Name:</label>
        <input type="text" class="form-control" name="up_ctg_name" value="<?php echo $get_rows['ctg_name']; ?>" />
    </div>

    <div class="form-group">
        <label for="ctg-des">Category Description:</label>
        <input type="text" class="form-control" name="up_ctg_des" value="<?php echo $get_rows['ctg_des']; ?>" />
    </div>
    <input type="submit" class="btn btn-success" name="update_cat_btn" value="Update Category">
</form>