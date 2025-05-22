<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kader') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kader</title>
    <link rel="stylesheet" href="kader.css">
</head>
<body>

<div class="header">
    <h2>Dashboard Kader Posyandu</h2>
    <p>Selamat datang, <?php echo $_SESSION['username']; ?>!</p>
</div>

<div class="menu">
    <a href="bayi.php">Tambah Data Bayi</a>
    <a href="data_bayi.php">Lihat Data Bayi</a>
    <a href="pertumbuhan.php">Pertumbuhan Bayi</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>