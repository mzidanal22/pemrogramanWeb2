<?php
include '../config.php';

$id = $_GET['id'];

// Hapus data anak (pengurusan) dulu, baru hapus data daftar ulang
$conn->query("DELETE FROM pengurusan WHERE id_daftar_ulang = $id");
$conn->query("DELETE FROM daftar_ulang WHERE id_daftar_ulang = $id");

header("Location: ../daftar_ulang.php");
exit;
?>
