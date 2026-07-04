<?php
// =========================================================
// START SESSION FOR NOTIFICATIONS
session_start();
// =========================================================
// KONEKSI DATABASE
// Sesuaikan username/password jika XAMPP/Laragon kamu
// menggunakan password (default XAMPP: user=root, pass=kosong)
// =========================================================
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_paspor";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set default timezone supaya perhitungan tanggal konsisten
date_default_timezone_set('Asia/Jakarta');
?>
