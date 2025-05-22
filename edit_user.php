<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$koneksi = new mysqli("localhost", "root", "", "posyandu");
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $query = "UPDATE users SET username='$username', role='$role' WHERE id=$id";
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id";
    }
    $koneksi->query($query);
    echo "<script>alert('Users diperbarui');window.location='kelola_user.php';</script>";
}
?>
<link rel="stylesheet" href="edit.css">
<h2>Edit User</h2>
<form method="post">
    Username: <input type="text" name="username" value="<?= $data['username'] ?>" required><br><br>
    Password: <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"><br><br>
    Role:
    <select name="role" required>
        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="kader" <?= $data['role'] == 'kader' ? 'selected' : '' ?>>Kader</option>
    </select><br><br>
    <button type="submit">Update</button>
</form>
<a href="user.php" class="btn-back">Kembali</a>