<?php
// process_login.php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and Password are required!";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['fullname']  = $user['fullname'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['role']      = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } elseif ($user['role'] == 'teacher') {
                header("Location: teacher/dashboard.php");
            } else {
                header("Location: student/dashboard.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password!";
        }
    } else {
        $_SESSION['error'] = "No account found with this email!";
    }

    header("Location: login.php");
    exit();
} else {
    header("Location: login.php");
}
?>