<?php
// process_signup.php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    if (empty($fullname) || empty($email) || empty($password) || empty($role)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: signup.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, password, role, created_at) 
            VALUES ('$fullname', '$email', '$hashed_password', '$role', NOW())";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Account created successfully! Please login.";
        header("Location: login.php");
    } else {
        // Show real error for debugging
        $_SESSION['error'] = "Registration failed: " . mysqli_error($conn);
        header("Location: signup.php");
    }
} else {
    header("Location: signup.php");
}
?>