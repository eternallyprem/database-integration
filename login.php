<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Establishing Database connection
$con = new mysqli("localhost", "root", "", "musicdb");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();

        if (password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid Email or Password";
            header("Location: login.html");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Invalid Email or Password";
        header("Location: login.html");
        exit();
    }
}
?>