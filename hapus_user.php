<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$koneksi = new mysqli("localhost", "root", "", "posyandu");
$id = $_GET['id'];
$koneksi->query("DELETE FROM users WHERE id=$id");
header("Location: user.php");
exit();