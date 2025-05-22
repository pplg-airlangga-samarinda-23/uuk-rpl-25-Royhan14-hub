<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "posyandu");
$data = $koneksi->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

<h2>Kelola User</h2>
<a href="admin_dasboard.php" class="btn"> Kembali ke Dashboard</a>
<a href="tambah_user.php" class="btn btn-success">+ Tambah User</a>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= $row['role'] ?></td>
        <td>
            <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
            <a href="hapus_user.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>