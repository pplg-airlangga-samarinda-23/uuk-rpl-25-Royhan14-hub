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
    $nama_bayi = $_POST["nama_bayi"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $nama_ibu = $_POST["nama_ibu"];
    $tinggi_badan = $_POST["tinggi_badan"];
    $berat_badan = $_POST["berat_badan"];
    $tanggal_catat = $_POST["tanggal_catat"];
    $alamat = $_POST["alamat"];

    $query = "INSERT INTO bayi 
        (nama_bayi, tanggal_lahir, jenis_kelamin, nama_ibu, tinggi_badan, berat_badan, tanggal_catat, alamat)
        VALUES 
        ('$nama_bayi', '$tanggal_lahir', '$jenis_kelamin', '$nama_ibu', '$tinggi_badan', '$berat_badan', '$tanggal_catat', '$alamat')";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data bayi berhasil ditambahkan'); window.location='dashboard_kader.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Bayi</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>

<h2>Tambah Data Bayi</h2>

<form method="post" action="">
    <label>Nama Bayi</label>
    <input type="text" name="nama_bayi" required>

    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" required>

    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <label>Nama Ibu</label>
    <input type="text" name="nama_ibu" required>

    <label>Tinggi Badan (cm)</label>
    <input type="number" step="0.1" name="tinggi_badan" required>

    <label>Berat Badan (kg)</label>
    <input type="number" step="0.1" name="berat_badan" required>

    <label>Tanggal Pencatatan</label>
    <input type="date" name="tanggal_catat" required>

    <label>Alamat</label>
    <textarea name="alamat" rows="3" required></textarea>

    <button type="submit">Simpan</button>
</form>

</body>
</html>