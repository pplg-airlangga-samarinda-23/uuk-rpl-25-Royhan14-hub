<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kader') {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "posyandu");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_bayi = $koneksi->real_escape_string($_POST["nama_bayi"]);
    $tanggal_lahir = $koneksi->real_escape_string($_POST["tanggal_lahir"]);
    $jenis_kelamin = $koneksi->real_escape_string($_POST["jenis_kelamin"]);
    $nama_ibu = $koneksi->real_escape_string($_POST["nama_ibu"]);
    $tanggal_catat = $koneksi->real_escape_string($_POST["tanggal_catat"]);
    $alamat = $koneksi->real_escape_string($_POST["alamat"]);

    $query = "INSERT INTO bayi 
        (nama_bayi, tanggal_lahir, jenis_kelamin, nama_ibu, tanggal_catat, alamat)
        VALUES 
        ('$nama_bayi', '$tanggal_lahir', '$jenis_kelamin', '$nama_ibu', '$tanggal_catat', '$alamat')";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data bayi berhasil ditambahkan'); window.location='dashboard_kader.php';</script>";
        exit();
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Bayi</title>
    <link rel="stylesheet" href="bayi.css">
</head>
<body>

<a href="kader_dasboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>

<h2>Tambah Data Bayi</h2>

<form method="post" action="">
    <label for="nama_bayi">Nama Bayi</label>
    <input type="text" id="nama_bayi" name="nama_bayi" required>

    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <label for="nama_ibu">Nama Ibu</label>
    <input type="text" id="nama_ibu" name="nama_ibu" required>

    <label for="tanggal_catat">Tanggal Pencatatan</label>
    <input type="date" id="tanggal_catat" name="tanggal_catat" required>

    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3" required></textarea>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
