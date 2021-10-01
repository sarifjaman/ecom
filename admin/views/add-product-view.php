<?php
$obj_adminback = new adminBack();
$res = $obj_adminback->p_display_category();

if (isset($_POST['pdt_btn'])) {
    $ret_msg = $obj_adminback->add_product($_POST);
}

?>

<h2>Add Product</h2>
<br>
<?php
if (isset($ret_msg)) {
    echo $ret_msg;
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="pdt-name">Product Name:</label>
        <input type="text" name="pdt_name" class="form-control" placeholder="" />
    </div>

    <div class="form-group">
        <label for="pdt-price">Product Price:</label>
        <input type="number" name="pdt_price" class="form-control" placeholder="" />
    </div>

    <div class="form-group">
        <label for="pdt-des">Product Description:</label>
        <textarea name="pdt_des" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="pdt-ctg">Product Category</label>
        <select class="form-control" name="pdt-ctg">
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
        <label for="pdt-image">Product Image:</label>
        <input type="file" name="pdt_image" class="form-control" />
    </div>

    <div class="form-group">
        <label for="pdt-status">Product Status:</label>
        <select name="pdt_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>

    <input type="submit" name="pdt_btn" class="btn btn-primary btn-block" value="Add Product" />
</form>