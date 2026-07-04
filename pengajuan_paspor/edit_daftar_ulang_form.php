<?php include 'config.php';

// Use prepared statements to prevent SQL injection
$id = $_GET['id'] ?? 0; // Use null coalescing operator for safety
$stmt = $conn->prepare("SELECT * FROM daftar_ulang WHERE id_daftar_ulang = ?");
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
    <title>Edit Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Data Daftar Ulang</div>
        <div class="card-body">
            <form action="proses/edit_daftar_ulang.php" method="POST" class="row g-3">
                <input type="hidden" name="id_daftar_ulang" value="<?= $row['id_daftar_ulang'] ?>">
                <input type="hidden" name="no_daftar" value="<?= $row['no_daftar'] ?>">

                <div class="col-md-6">
                    <label class="form-label">Keperluan</label>
                    <input type="text" name="keperluan" class="form-control" value="<?= htmlspecialchars($row['keperluan']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hari Datang (Daftar Ulang)</label>
                    <select name="hari_daftar_ulang" class="form-select" required>
                        <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h) {
                            $sel = $h == $row['hari_daftar_ulang'] ? 'selected' : '';
                            echo "<option value='$h' $sel>$h</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tgl Datang (Daftar Ulang)</label>
                    <input type="date" name="tgl_daftar_ulang" class="form-control" value="<?= $row['tgl_daftar_ulang'] ?>" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Berkas</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ktp" value="Ada" <?= $row['ktp']=='Ada'?'checked':'' ?>>
                        <label class="form-check-label">KTP</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kk" value="Ada" <?= $row['kk']=='Ada'?'checked':'' ?>>
                        <label class="form-check-label">KK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ijazah_akta" value="Ada" <?= $row['ijazah_akta']=='Ada'?'checked':'' ?>>
                        <label class="form-check-label">Ijazah/Akta</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="daftar_ulang.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
