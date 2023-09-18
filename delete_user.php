<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Query untuk menghapus data pengguna berdasarkan ID
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error dalam persiapan statement: " . $mysqli->error);
    }

    // Bind parameter
    $stmt->bind_param("i", $userId);

    // Eksekusi statement SQL
    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Gagal menghapus data pengguna: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID user tidak diberikan.";
}
?>
