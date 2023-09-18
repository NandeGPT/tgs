<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error dalam persiapan statement: " . $mysqli->error);
    }

    // Bind parameter
    $stmt->bind_param("i", $userId);

    // Eksekusi statement SQL
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $userData = $result->fetch_assoc();

            // Form untuk mengedit data pengguna
            ?>
            <html>
            <head>
                <title>Edit User</title>
            </head>
            <body>
                <h2>Edit User</h2>
                <form method="post" action="update_user.php">
                    <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="<?php echo $userData['username']; ?>" required><br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $userData['email']; ?>" required><br>
                    <input type="submit" value="Simpan Perubahan">
                </form>
                <br>
                <a href="dashboard.php">Kembali ke Dashboard</a>
            </body>
            </html>
            <?php
        } else {
            echo "User tidak ditemukan.";
        }
    } else {
        echo "Gagal mengambil data user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID user tidak diberikan.";
}
?>
