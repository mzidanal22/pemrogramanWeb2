<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $no_daftar    = $_POST['no_daftar'];
    $nama_pemohon = $conn->real_escape_string($_POST['nama_pemohon']);
    $tgl_daftar   = $_POST['tgl_daftar'];

    // Hitung ulang jadwal datang (kapasitas 5 orang/hari),
    // dengan mengabaikan data dirinya sendiri saat menghitung jumlah per hari
    $tanggal_cek = new DateTime($tgl_daftar);

    while (true) {
        $tanggal_format = $tanggal_cek->format('Y-m-d');

        $cek = $conn->query("SELECT COUNT(*) as jumlah FROM pendaftar 
                              WHERE tanggal = '$tanggal_format' AND no_daftar != $no_daftar");
        $jumlah = $cek->fetch_assoc()['jumlah'];

        if ($jumlah < 5) {
            break;
        }
        $tanggal_cek->modify('+1 day');
    }

    $tanggal_datang = $tanggal_cek->format('Y-m-d');
    $nama_hari_en = $tanggal_cek->format('l');
    $hari_indo = [
        'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
    ];
    $hari_datang = $hari_indo[$nama_hari_en];

    $stmt = $conn->prepare("UPDATE pendaftar SET nama_pemohon=?, tgl_daftar=?, hari=?, tanggal=? WHERE no_daftar=?");
    $stmt->bind_param("ssssi", $nama_pemohon, $tgl_daftar, $hari_datang, $tanggal_datang, $no_daftar);
    $stmt->execute();

    header("Location: ../daftar.php");
    exit;
}
?>
