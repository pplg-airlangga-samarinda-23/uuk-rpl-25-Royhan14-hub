<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
$dashboard = ($_SESSION['role'] == 'admin') ? 'admin_dasboard.php' : 'kader_dasboard.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <h1>Dashboard Admin</h1>

    <div class="menu">
        <a href="user.php">Kelola User</a>
        <a href="data_bayi.php">Data Bayi</a>
        <a href="pertumbuhan.php">Pertumbuhan Bayi</a>
    </div>

    <a class="logout" href="logout.php">Logout</a>

</body>
</html>
