<?php
class adminBack
{
    private $conn;

    public function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "ecom";

        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$this->conn) {
            die("Database connection failed!");
        }
    }

    function admin_login($data)
    {
        $admin_email = $data['admin_email'];
        // $admin_pass = hash('sha256', $data['admin_pass']);
        $admin_pass = md5($data['admin_pass']);

        $sql = "SELECT * FROM adminlog WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";

        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $admin_info = mysqli_fetch_assoc($query);

            if ($admin_info) {
                header('location:dashboard.php');
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['adminEmail'] = $admin_info['admin_email'];
                $_SESSION['adminPass'] = $admin_info['admin_pass'];
            } else {
                $errmsg = "<p>Your username or password is incorrect.</p>";
                return $errmsg;
            }
        }
    }

    function adminlogout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['adminEmail']);
        unset($_SESSION['adminPass']);
        header('location:index.php');
    }

    function add_category($data)
    {
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];

        $sql = "INSERT INTO category(ctg_name,ctg_des,ctg_status) VALUES('$ctg_name','$ctg_des',$ctg_status)";

        if (mysqli_query($this->conn, $sql)) {
            $_SESSION['message'] = "<p class='success-msg'>Category added successfully.</p>";
            return $_SESSION['message'];
        } else {
            $_SESSION['message'] = "<p class='err-msg'>Category not added</p>";
            return $_SESSION['message'];
        }
    }

    function display_category()
    {
        $sql = "SELECT * FROM category";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
    }

    function cat_publish($id)
    {
        $sql = "UPDATE category SET ctg_status=1 WHERE ctg_id=$id";
        mysqli_query($this->conn, $sql);
    }

    function cat_unpublish($id)
    {
        $sql = "UPDATE category SET ctg_status=0 WHERE ctg_id=$id";
        mysqli_query($this->conn, $sql);
    }

    function cat_delete($id)
    {
        $sql = "DELETE FROM category WHERE ctg_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $msg = "<p class='success-msg'>Category deleted successfully.</p>";
            return $msg;
        } else {
            $msg = "<p class='err-msg'>Failed to delete category.</p>";
            return $msg;
        }
    }

    function BupdatePageShow($id)
    {
        $sql = "SELECT * FROM category WHERE ctg_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $rows = mysqli_fetch_assoc($query);
            return $rows;
        }
    }

    function updateCategory($data)
    {
        $ctg_name = $data['up_ctg_name'];
        $ctg_des = $data['up_ctg_des'];
        $ctg_id = $data['up_ctg_id'];

        $sql = "UPDATE category SET ctg_name='$ctg_name',ctg_des='$ctg_des' WHERE ctg_id=$ctg_id";
        if (mysqli_query($this->conn, $sql)) {
            $msg = "<p class='success-msg'>Category updated successfully.</p>";
            return $msg;
        } else {
            $msg = "<p class='err-msg'>Failed to updated category.</p>";
            return $msg;
        }
    }

    function add_product($data)
    {
        $pdt_name = $data['pdt_name'];
        $pdt_price = $data['pdt_price'];
        $pdt_des = $data['pdt_des'];
        $pdt_ctg = $data['pdt-ctg'];
        $pdt_image_name = $_FILES['pdt_image']['name'];
        $pdt_tmp_file = $_FILES['pdt_image']['tmp_name'];
        $pdt_image_size = $_FILES['pdt_image']['size'];
        $pdt_ext = pathinfo($pdt_image_name, PATHINFO_EXTENSION);
        $pdt_status = $data['pdt_status'];

        if ($pdt_ext == "jpg" or $pdt_ext == "JPG" or $pdt_ext == "jpeg" or $pdt_ext == "JPEG" or $pdt_ext == "png" or $pdt_ext == "PNG" or $pdt_ext == "gif" or $pdt_ext == "GIF") {
            if ($pdt_image_size <= 3145728) {
                $sql = "INSERT INTO product(pdt_name,pdt_price,pdt_des,pdt_ctg,pdt_image,pdt_status) VALUES('$pdt_name',$pdt_price,'$pdt_des','$pdt_ctg','$pdt_image_name','$pdt_status')";
                if (mysqli_query($this->conn, $sql)) {
                    move_uploaded_file($pdt_tmp_file, 'upload/' . $pdt_image_name);
                    $msg = "<p class='success-msg'>Product added successfully.</p>";
                    return $msg;
                }
            } else {
                $msg = "<p class='err-msg'>Your file size should be less or equal 3 MB.</p>";
                return $msg;
            }
        } else {
            $msg = "<p class='err-msg'>Your file must be a JPG or JPEG or png or gif file.</p>";
            return $msg;
        }
    }
}
