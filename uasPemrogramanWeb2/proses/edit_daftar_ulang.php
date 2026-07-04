<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_daftar_ulang   = $_POST['id_daftar_ulang'];
    $no_daftar         = $_POST['no_daftar'];
    $keperluan         = $conn->real_escape_string($_POST['keperluan']);
    $hari_daftar_ulang = $_POST['hari_daftar_ulang'];
    $tgl_daftar_ulang  = $_POST['tgl_daftar_ulang'];

    $ktp         = isset($_POST['ktp']) ? 'Ada' : 'Tidak';
    $kk          = isset($_POST['kk']) ? 'Ada' : 'Tidak';
    $ijazah_akta = isset($_POST['ijazah_akta']) ? 'Ada' : 'Tidak';

    // Hitung ulang keterangan (logika sama seperti simpan_daftar_ulang.php)
    $jadwal = $conn->query("SELECT hari, tanggal FROM pendaftar WHERE no_daftar = $no_daftar")->fetch_assoc();

    $keterangan = ($jadwal['hari'] == $hari_daftar_ulang && $jadwal['tanggal'] == $tgl_daftar_ulang) ? 'OK' : 'tidak';

    // Ambil no_antrian yang sudah ada (jika sebelumnya sudah OK)
    $data_lama = $conn->query("SELECT no_antrian FROM daftar_ulang WHERE id_daftar_ulang = $id_daftar_ulang")->fetch_assoc();
    $no_antrian_lama = $data_lama['no_antrian'];

    if ($keterangan == 'OK' && $no_antrian_lama === null) {
        // Baru jadi OK -> beri nomor antrian baru
        $max = $conn->query("SELECT MAX(no_antrian) as max_antrian FROM daftar_ulang")->fetch_assoc()['max_antrian'];
        $no_antrian_sql = $max ? $max + 1 : 1;
    } elseif ($keterangan == 'tidak') {
        // Jadi tidak OK -> hapus nomor antrian
        $no_antrian_sql = "NULL";
    } else {
        // Tetap OK -> pertahankan nomor antrian lama
        $no_antrian_sql = $no_antrian_lama;
    }

    $stmt = $conn->prepare("UPDATE daftar_ulang SET keperluan=?, hari_daftar_ulang=?, tgl_daftar_ulang=?, ktp=?, kk=?, ijazah_akta=?, keterangan=? WHERE id_daftar_ulang=?");
    $stmt->bind_param("sssssssi", $keperluan, $hari_daftar_ulang, $tgl_daftar_ulang, $ktp, $kk, $ijazah_akta, $keterangan, $id_daftar_ulang);
    $stmt->execute();

    $conn->query("UPDATE daftar_ulang SET no_antrian = $no_antrian_sql WHERE id_daftar_ulang = $id_daftar_ulang");

    header("Location: ../daftar_ulang.php");
    exit;
}
?>
