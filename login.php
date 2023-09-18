<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $mysqli->prepare("SELECT id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];


        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;

            header('Location: dashboard.php'); 
            exit();
        } else {
            echo 'Invalid username or password';
        }
    } else {
        echo 'Invalid username or password';
    }

    $stmt->close();
}
?>
