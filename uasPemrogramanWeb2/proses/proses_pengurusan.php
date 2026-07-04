<?php
include '../config.php';

// =========================================================
// LOGIKA UTAMA:
// Ambil semua data dari daftar_ulang yang:
// 1. Sudah punya no_antrian (artinya keterangan sebelumnya = OK)
// 2. BELUM pernah diproses ke tabel pengurusan
//
// Untuk setiap data tsb, cek kelengkapan berkas:
// - Jika KTP = Ada, KK = Ada, Ijazah/Akta = Ada -> berkas = "lengkap"
//      -> status = "diterima", keterangan = "OK", pembayaran = 355000
// - Jika salah satu tidak ada -> berkas = "tidak lengkap"
//      -> status = "ditolak", keterangan = "kurang lengkap", pembayaran = 0
// =========================================================

$query = "SELECT du.* FROM daftar_ulang du
          LEFT JOIN pengurusan p ON du.id_daftar_ulang = p.id_daftar_ulang
          WHERE du.no_antrian IS NOT NULL AND p.id_daftar_ulang IS NULL";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {

    $lengkap = ($row['ktp'] == 'Ada' && $row['kk'] == 'Ada' && $row['ijazah_akta'] == 'Ada');

    if ($lengkap) {
        $berkas = 'lengkap';
        $status = 'diterima';
        $keterangan = 'OK';
        $pembayaran = 355000;
    } else {
        $berkas = 'tidak lengkap';
        $status = 'ditolak';
        $keterangan = 'kurang lengkap';
        $pembayaran = 0;
    }

    $stmt = $conn->prepare("INSERT INTO pengurusan 
        (id_daftar_ulang, no_antrian, no_daftar, nama_pemohon, berkas, status, keterangan, pembayaran) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissssi", 
        $row['id_daftar_ulang'], 
        $row['no_antrian'], 
        $row['no_daftar'], 
        $row['nama_pemohon'], 
        $berkas, 
        $status, 
        $keterangan, 
        $pembayaran
    );
    $stmt->execute();
}

header("Location: ../pengurusan.php");
exit;
?>
