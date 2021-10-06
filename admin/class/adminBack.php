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

    function p_display_category()
    {
        $sql = "SELECT * FROM category WHERE ctg_status=1";
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
        //image file path
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

    function display_product()
    {
        $sql = "SELECT * FROM product_info_ctg";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
    }

    function delete_product($id)
    {
        $sql = "DELETE FROM product WHERE pdt_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $msg = "<p class='success-msg'>Product deleted successfully.</p>";
            return $msg;
        } else {
            $msg = "<p class='err-msg'>Failed to product deleted.</p>";
            return $msg;
        }
    }

    function geteditProduct_info($id)
    {
        $sql = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $res = mysqli_fetch_assoc($query);
            return $res;
        }
    }

    function update_product($data)
    {
        $up_pdt_id = $data['up_pdt_id'];
        $up_pdt_name = $data['up_pdt_name'];
        $up_pdt_price = $data['up_pdt_price'];
        $up_pdt_des = $data['up_pdt_price'];
        $up_pdt_ctg = $data['up_pdt-ctg'];
        $up_image_name = $_FILES['up_pdt_image']['name'];
        $up_image_size = $_FILES['up_pdt_image']['size'];
        $up_pdt_tmp_image = $_FILES['up_pdt_image']['tmp_name'];
        $up_image_ext = pathinfo($up_image_name, PATHINFO_EXTENSION);
        $up_pdt_status = $data['up_pdt_status'];

        if ($up_image_ext == "jpg" or  $up_image_ext == "JPG" or  $up_image_ext == "png" or  $up_image_ext == "PNG" or  $up_image_ext == "jpeg" or  $up_image_ext == "JPEG") {
            if ($up_image_size <= 3145728) {
                $sql = "UPDATE product SET
                 pdt_name='$up_pdt_name',
                 pdt_price=$up_pdt_price,
                 pdt_des='$up_pdt_des',
                 pdt_ctg='$up_pdt_ctg',
                 pdt_image='$up_image_name',
                 pdt_status=$up_pdt_status
                  WHERE pdt_id=$up_pdt_id";
                if (mysqli_query($this->conn, $sql)) {
                    move_uploaded_file($up_pdt_tmp_image, 'upload/' . $up_image_name);
                    $msg = "<p class='success-msg'>Product updated successfully.</p>";
                    return $msg;
                }
                // else {
                //     $msg = "<p class='err-msg'>Failed to update product.</p>";
                //     return $msg;
                // }
            } else {
                $msg = "<p class='err-msg'>Your file size should be less or equal 3 MB.</p>";
                return $msg;
            }
        } else {
            $msg = "<p class='err-msg'>Your file must be a JPG or JPEG or png or gif file.</p>";
            return $msg;
        }
    }

    function product_by_ctg($id)
    {
        $sql = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $proinfo = mysqli_query($this->conn, $sql);
            return $proinfo;
        }
    }

    function product_by_id($id)
    {
        $sql = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $proinfo = mysqli_query($this->conn, $sql);
            return $proinfo;
        }
    }

    function related_product($id)
    {
        $sql = "SELECT * FROM product_info_ctg WHERE ctg_id=$id ORDER BY pdt_id DESC LIMIT 3";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
    }

    function ctg_by_id($id)
    {
        $sql = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $data_fetch = mysqli_fetch_assoc($query);
            return $data_fetch;
        }
    }

    function user_register($data)
    {
        $username = $data['username'];
        $user_firstname = $data['user_firstname'];
        $user_lastname = $data['user_lastname'];
        $useremail = $data['useremail'];
        $phonenumber = $data['phonenumber'];
        $user_pass = md5($data['user_pass']);
        $user_rules = $data['user_rules'];

        $err_match_data = "SELECT * FROM users WHERE user_name='$username' OR user_email='$useremail'";
        $sent_data = mysqli_query($this->conn, $err_match_data);
        $count = mysqli_num_rows($sent_data);

        if ($count == 1) {
            $msg = "<p class='err-msg'>This Username or Email Address Already Exists!</p>";
            return $msg;
        } else {
            if (strlen($phonenumber) < 11 or strlen($phonenumber) > 11) {
                $msg = "<p class='err-msg'>Your mobile number should not be less than 11 or greater than 11.</p>";
                return $msg;
            } else {
                $sql = "INSERT INTO users(user_name,user_firstname,user_lastname,user_email,user_password,user_mobile,user_rules)VALUES('$username','$user_firstname','$user_lastname','$useremail','$user_pass',$phonenumber,$user_rules)";

                if (mysqli_query($this->conn, $sql)) {
                    $msg = "<p class='success-msg'>Your account successfully registered!</p>";
                    return $msg;
                } else {
                    $msg = "<p class='err-msg'>Failed to registered!</p>";
                    return $msg;
                }
            }
        }
    }

    function user_login($data)
    {
        $user_email = $data['useremail'];
        $user_pass = md5($data['user_pass']);

        $sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_pass'";
        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $rows = mysqli_fetch_assoc($query);

            if ($rows) {
                header("location:user_profile.php");
                session_start();
                $_SESSION['user_id'] = $rows['user_id'];
                $_SESSION['email'] = $rows['user_email'];
                $_SESSION['name'] = $rows['user_name'];
                $_SESSION['pass'] = $rows['user_password'];
            } else {
                $msg = "<p class='err-msg'>Your email or password is incorrect!</p>";
                return $msg;
            }
        }
    }

    function user_logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['pass']);
        header("location:user_login.php");
    }
}
