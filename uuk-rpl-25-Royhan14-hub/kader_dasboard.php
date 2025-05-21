<?php
session_start();

// Cek apakah user sudah login dan memiliki role kader
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
    <a href="tambah_bayi.php">Tambah Data Bayi</a>
    <a href="lihat_bayi.php">Lihat Data Bayi</a>
    <a href="catat_pertumbuhan.php">Catat Pertumbuhan</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>