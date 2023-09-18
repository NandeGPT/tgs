<?php
session_start();
require_once('config.php'); // Include your database connection script here.

if (isset($_SESSION['username'])) {
    // Retrieve all user data from the database
    $sql = "SELECT * FROM user";
    $result = mysqli_query($mysqli, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Store all user data in an array
        $userArray = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $userArray[] = $row;
        }
    } else {
        echo 'No user data found.';
    }
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: index.php');
    exit();
}
?>

<html>
<head>
    <title>Dashboard</title>
</head>
<style>
    table, th, td {
    border: 1px solid black;
    width: 50%;
    text-align: center;
    }
</style>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($userArray as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $user['id']; ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="logout.php">
        <input type="button" value="Log Out">
    </a>
</body>
</html>
