<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari formulir
    $userId = $_POST['id'];
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    // Query untuk mengupdate data pengguna
    $sql = "UPDATE user SET username = ?, email = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error dalam persiapan statement: " . $mysqli->error);
    }

    // Bind parameter
    $stmt->bind_param("ssi", $newUsername, $newEmail, $userId);

    // Eksekusi statement SQL
    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Gagal mengupdate data pengguna: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Permintaan tidak valid.";
}
?>
