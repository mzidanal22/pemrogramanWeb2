<?php include 'config.php';

// Use prepared statements to prevent SQL injection
$id = $_GET['id'] ?? 0; // Use null coalescing operator for safety
$stmt = $conn->prepare("SELECT * FROM pendaftar WHERE no_daftar = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) { die("Data tidak ditemukan."); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Data Pendaftar</div>
        <div class="card-body">
            <form action="proses/edit_daftar.php" method="POST" class="row g-3">
                <input type="hidden" name="no_daftar" value="<?= $row['no_daftar'] ?>">
                <div class="col-md-6">
                    <label class="form-label">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" value="<?= htmlspecialchars($row['nama_pemohon']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Daftar</label>
                    <input type="date" name="tgl_daftar" class="form-control" value="<?= $row['tgl_daftar'] ?>" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="daftar.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
            <p class="text-muted mt-2">*Catatan: Hari & Tanggal Datang akan dihitung ulang otomatis berdasarkan kapasitas terbaru.</p>
        </div>
    </div>
</div>
</body>
</html>
