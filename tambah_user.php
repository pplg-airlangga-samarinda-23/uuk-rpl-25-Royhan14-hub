<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$koneksi = new mysqli("localhost", "root", "", "posyandu");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $koneksi->real_escape_string($_POST['role']);

    $koneksi->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    echo "<script>alert('Users berhasil ditambahkan');window.location='user.php';</script>";
}
?>
<link rel="stylesheet" href="tambah.css">
<h2>Tambah User</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Role:
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="kader">Kader</option>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
<a href="user.php" class="btn-back">Kembali</a>