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
        $admin_pass = hash('sha256', $data['admin_pass']);

        $sql = "SELECT * FROM adminlog WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";

        if (mysqli_query($this->conn, $sql)) {
            $query = mysqli_query($this->conn, $sql);
            $admin_info = mysqli_fetch_assoc($query);

            if ($admin_info) {
                header('location:dashboard.php');
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['adminEmail'] = $admin_info['admin_email'];
            } else {
                $errmsg = "<p>Your username or password is incorrect.</p>";
                return $errmsg;
            }
        }
    }
}
