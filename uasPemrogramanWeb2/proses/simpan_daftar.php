<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_pemohon = $conn->real_escape_string($_POST['nama_pemohon']);
    $tgl_daftar   = $_POST['tgl_daftar'];

    // =====================================================
    // LOGIKA UTAMA:
    // Kapasitas 1 hari maksimal 5 orang.
    // Mulai dari tanggal daftar, cek apakah hari itu sudah
    // penuh (>=5 pendaftar dengan tanggal "datang" yang sama).
    // Jika penuh, majukan 1 hari, cek lagi, sampai ketemu
    // hari yang kuotanya belum penuh.
    // =====================================================

    $tanggal_cek = new DateTime($tgl_daftar);

    while (true) {
        $tanggal_format = $tanggal_cek->format('Y-m-d');

        // Hitung jumlah orang yang sudah dijadwalkan datang di tanggal ini
        $cek = $conn->query("SELECT COUNT(*) as jumlah FROM pendaftar WHERE tanggal = '$tanggal_format'");
        $jumlah = $cek->fetch_assoc()['jumlah'];

        if ($jumlah < 5) {
            // Kuota hari ini masih tersedia -> pakai tanggal ini
            break;
        }

        // Kuota penuh -> majukan ke hari berikutnya
        $tanggal_cek->modify('+1 day');
    }

    $tanggal_datang = $tanggal_cek->format('Y-m-d');

    // Nama hari dalam Bahasa Indonesia
    $nama_hari_en = $tanggal_cek->format('l');
    $hari_indo = [
        'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
    ];
    $hari_datang = $hari_indo[$nama_hari_en];

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO pendaftar (nama_pemohon, tgl_daftar, hari, tanggal) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama_pemohon, $tgl_daftar, $hari_datang, $tanggal_datang);
    $stmt->execute();

    header("Location: ../daftar.php");
    exit;
}
?>
