<?php
$obj_adminback = new adminBack();
$res = $obj_adminback->display_category();


if (isset($_GET['prostatus'])) {
    $get_id = $_GET['id'];
    if ($_GET['prostatus'] == 'edit') {
        $ret_res = $obj_adminback->geteditProduct_info($get_id);
    }
}

if (isset($_POST['up_pdt_btn'])) {
    $ret_msg = $obj_adminback->update_product($_POST);
}
?>

<h2>Update Product</h2>
<br>
<?php
if (isset($ret_msg)) {
    echo $ret_msg;
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input hidden type="text" name="up_pdt_id" class="form-control" value="<?php echo $ret_res['pdt_id']; ?>" />
    </div>

    <div class="form-group">
        <label for="up-pdt-name">Product Name:</label>
        <input type="text" name="up_pdt_name" class="form-control" value="<?php echo $ret_res['pdt_name']; ?>" />
    </div>

    <div class="form-group">
        <label for="up-pdt-price">Product Price:</label>
        <input type="number" name="up_pdt_price" class="form-control" value="<?php echo $ret_res['pdt_price']; ?>" />
    </div>

    <div class="form-group">
        <label for="up-pdt-des">Product Description:</label>
        <textarea name="up_pdt_des" rows="3" class="form-control"><?php echo $ret_res['pdt_des']; ?></textarea>
    </div>

    <div class="form-group">
        <label for="up-pdt-ctg">Product Category</label>
        <select class="form-control" name="up_pdt-ctg">
            <option value="">Please select a category</option>
            <?php
            while ($rows = mysqli_fetch_assoc($res)) {
            ?>
                <option value="<?php echo $rows['ctg_id']; ?>"><?php echo $rows['ctg_name']; ?></option>
            <?php
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="up-pdt-image">Product Image:</label>
        <input type="file" name="up_pdt_image" class="form-control" />
    </div>

    <div class="form-group">
        <label for="up-pdt-status">Product Status:</label>
        <select name="up_pdt_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>

    <input type="submit" name="up_pdt_btn" class="btn btn-primary btn-block" value="Update Product" />
</form>