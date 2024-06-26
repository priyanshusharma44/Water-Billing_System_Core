<?php
require_once("config.php");
session_start();
$logged = false;

if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    $logged = true;
    $email = $_SESSION['email'];
} else {
    $logged = false;
    $_SESSION['logged'] = false;
}

if ($logged != true) {
    $email = "";
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        $response = ['success' => false, 'message' => 'Invalid email or password'];

        // Check user table
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['user'] = $row['username'];
            $_SESSION['logged'] = true;
            $_SESSION['uid'] = $row['user_id'];
            $_SESSION['email'] = $email;
            $_SESSION['account'] = "user";
            $response = ['success' => true, 'redirect' => 'users/user/index.php'];
        }

        // Check admin table
        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['user'] = $row['username'];
            $_SESSION['logged'] = true;
            $_SESSION['aid'] = $row['admin_id'];
            $_SESSION['email'] = $email;
            $_SESSION['account'] = "admin";
            $response = ['success' => true, 'redirect' => 'users/admin/index.php'];
        }

        // Check meter_reader table
        $sql = "SELECT * FROM meter_reader WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['user'] = $row['username'];
            $_SESSION['logged'] = true;
            $_SESSION['rid'] = $row['reader_id'];
            $_SESSION['email'] = $email;
            $_SESSION['account'] = "reader";
            $response = ['success' => true, 'redirect' => 'users/reader/index.php'];
        }

        echo json_encode($response);
        exit();
    } else {
        $_SESSION['logged'] = false;
    }
}
?>