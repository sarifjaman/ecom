<?php
$obj_adminback = new adminBack();
if (isset($_POST['ctg_btn'])) {
    $ret_msg = $obj_adminback->add_category($_POST);
}
?>

<h2>Add Category</h2>
<br>
<?php
if (isset($ret_msg)) {
    echo $ret_msg;
    unset($ret_msg);
}
?>

<form action="" method="post">
    <div class="form-group">
        <label for="ctg-name">Category Name:</label>
        <input type="text" name="ctg_name" class="form-control" />
    </div>

    <div class="form-group">
        <label for="ctg_des">Category Description:</label>
        <input type="text" name="ctg_des" class="form-control" />
    </div>

    <div class="form-group">
        <label for="ctg_status">Category Status:</label>
        <select name="ctg_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>

    <input type="submit" name="ctg_btn" class="btn btn-primary" value="Add Category" />
</form>