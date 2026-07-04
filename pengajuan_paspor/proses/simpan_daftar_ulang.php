<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $no_daftar         = $_POST['no_daftar'];
    $keperluan         = $conn->real_escape_string($_POST['keperluan']);
    $hari_daftar_ulang = $_POST['hari_daftar_ulang'];
    $tgl_daftar_ulang  = $_POST['tgl_daftar_ulang'];

    // Checkbox: jika dicentang nilainya "Ada", jika tidak set manual "Tidak"
    $ktp         = isset($_POST['ktp']) ? 'Ada' : 'Tidak';
    $kk          = isset($_POST['kk']) ? 'Ada' : 'Tidak';
    $ijazah_akta = isset($_POST['ijazah_akta']) ? 'Ada' : 'Tidak';

    // =====================================================
    // LOGIKA UTAMA:
    // Ambil jadwal kedatangan asli (hari & tanggal) dari
    // tabel pendaftar berdasarkan no_daftar yang dipilih.
    // Bandingkan dengan hari & tanggal yang diinput user.
    // Jika SAMA PERSIS -> Keterangan = "OK"
    // Jika BEDA        -> Keterangan = "tidak"
    // =====================================================

    $jadwal = $conn->query("SELECT hari, tanggal FROM pendaftar WHERE no_daftar = $no_daftar")->fetch_assoc();
    $nama_pemohon = $conn->query("SELECT nama_pemohon FROM pendaftar WHERE no_daftar = $no_daftar")->fetch_assoc()['nama_pemohon'];

    $keterangan = null;
    if ($jadwal['hari'] == $hari_daftar_ulang && $jadwal['tanggal'] == $tgl_daftar_ulang) {
        $keterangan = 'OK';
    } else {
        $keterangan = 'tidak';
    }

    // Nomor antrian hanya diberikan jika keterangan = OK
    // Nomor antrian dibuat otomatis (increment dari nomor antrian tertinggi yang sudah ada)
    $no_antrian = null;
    if ($keterangan == 'OK') {
        $max = $conn->query("SELECT MAX(no_antrian) as max_antrian FROM daftar_ulang")->fetch_assoc()['max_antrian'];
        $no_antrian = $max ? $max + 1 : 1;
    }

    // Gunakan escaping manual untuk no_antrian karena nilainya bisa NULL
    $no_antrian_sql = $no_antrian === null ? "NULL" : (int)$no_antrian;

    $stmt = $conn->prepare("INSERT INTO daftar_ulang 
        (no_daftar, nama_pemohon, keperluan, hari_daftar_ulang, tgl_daftar_ulang, ktp, kk, ijazah_akta, keterangan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $no_daftar, $nama_pemohon, $keperluan, $hari_daftar_ulang, $tgl_daftar_ulang, $ktp, $kk, $ijazah_akta, $keterangan);
    $stmt->execute();

    // Update no_antrian secara terpisah (aman untuk nilai NULL)
    $insert_id = $conn->insert_id;
    $conn->query("UPDATE daftar_ulang SET no_antrian = $no_antrian_sql WHERE id_daftar_ulang = $insert_id");

    header("Location: ../daftar_ulang.php");
    exit;
}
?>
