<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'kader')) {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "posyandu");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = "SELECT * FROM bayi";
$result = $koneksi->query($query);

$dashboard = ($_SESSION['role'] == 'admin') ? 'admin_dasboard.php' : 'kader_dasboard.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Bayi</title>
    <link rel="stylesheet" href="data_bayi.css">
</head>
<body>

<h2>Data Bayi</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama Bayi</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Nama Ibu</th>
        <th>Alamat</th>
        <th>Tanggal Pencatatan</th>
    </tr>

    <?php
    $no = 1;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . htmlspecialchars($row['nama_bayi']) . "</td>
                <td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>
                <td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>
                <td>" . htmlspecialchars($row['nama_ibu']) . "</td>
                <td>" . htmlspecialchars($row['alamat']) . "</td>
                <td>" . htmlspecialchars($row['tanggal_catat']) . "</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Belum ada data bayi.</td></tr>";
    }
    ?>
</table>

<a href="<?= $dashboard ?>" class="btn-back">⬅ Kembali ke Dashboard</a>

</body>
</html>
