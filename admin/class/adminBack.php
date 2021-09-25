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
}
