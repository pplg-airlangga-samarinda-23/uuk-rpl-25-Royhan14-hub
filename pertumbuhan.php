<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'kader'])) {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "posyandu");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$result_bayi = $koneksi->query("SELECT id, nama_bayi FROM bayi ORDER BY nama_bayi ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bayi_id = $koneksi->real_escape_string($_POST['bayi_id']);
    $tanggal = $koneksi->real_escape_string($_POST['tanggal']);
    $tinggi_badan = $koneksi->real_escape_string($_POST['tinggi_badan']);
    $berat_badan = $koneksi->real_escape_string($_POST['berat_badan']);

    if (empty($bayi_id) || empty($tanggal) || empty($tinggi_badan) || empty($berat_badan)) {
        $error = "Semua data wajib diisi!";
    } else {
        $query = "INSERT INTO pertumbuhan (bayi_id, tanggal, tinggi_badan, berat_badan) 
                  VALUES ('$bayi_id', '$tanggal', '$tinggi_badan', '$berat_badan')";
        if ($koneksi->query($query) === TRUE) {
            echo "<script>alert('Data pertumbuhan berhasil ditambahkan'); window.location='tambah_pertumbuhan.php';</script>";
            exit();
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}

$dashboard = ($_SESSION['role'] == 'admin') ? 'admin_dasboard.php' : 'kader_dasboard.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pertumbuhan Bayi</title>
    <link rel="stylesheet" href="pertumbuhan.css">
</head>
<body>

<a href="<?= $dashboard ?>" class="btn-back">⬅ Kembali ke Dashboard</a>

<h2>Data Pertumbuhan Bayi</h2>

<?php if (isset($error)) : ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" action="">
    <label for="bayi_id">Pilih Bayi</label>
    <select name="bayi_id" id="bayi_id" required>
        <option value="">-- Pilih Bayi --</option>
        <?php
        if ($result_bayi->num_rows > 0) {
            while ($row = $result_bayi->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nama_bayi']) . "</option>";
            }
        } else {
            echo "<option value=''>Tidak ada data bayi</option>";
        }
        ?>
    </select>

    <label for="tanggal">Tanggal Pengukuran</label>
    <input type="date" name="tanggal" id="tanggal" required>

    <label for="tinggi_badan">Tinggi Badan (cm)</label>
    <input type="number" step="0.01" name="tinggi_badan" id="tinggi_badan" required>

    <label for="berat_badan">Berat Badan (kg)</label>
    <input type="number" step="0.01" name="berat_badan" id="berat_badan" required>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
