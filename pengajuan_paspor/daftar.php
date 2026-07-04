<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Paspor - Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Skrip ini ditempatkan di <head> untuk mencegah "flash" tema yang salah saat halaman dimuat.
        (function() {
            const getStoredTheme = () => localStorage.getItem('theme');
            const setStoredTheme = theme => localStorage.setItem('theme', theme);

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) {
                    return storedTheme;
                }
                // Fallback ke preferensi sistem operasi pengguna
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };

            const setTheme = theme => {
                document.documentElement.setAttribute('data-bs-theme', theme);
            };

            // Terapkan tema saat halaman pertama kali dimuat
            setTheme(getPreferredTheme());

            // Tambahkan listener untuk mengubah tema saat preferensi OS berubah (jika tidak ada tema yang disimpan)
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (!getStoredTheme()) {
                    setTheme(getPreferredTheme());
                }
            });
        })();
    </script>
</head>
<body class="bg-light">

<!-- SVG Icons untuk Toast -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></symbol>
</svg>

<div class="container mt-4">

    <div class="text-center mb-4">
        <h4>PENGAJUAN PASPOR</h4>
        <h6>Kantor Imigrasi Cabang</h6>
        <p class="text-muted">Muhammad Zidane - 211011450451</p>
    </div>
    
    <!-- Toggle Dark/Light Mode -->
    <div class="form-check form-switch position-absolute top-0 end-0 mt-3 me-3">
        <input class="form-check-input" type="checkbox" role="switch" id="theme-toggle">
        <label class="form-check-label" for="theme-toggle">Dark Mode</label>
    </div>

    <!-- Navigasi antar modul -->
    <ul class="nav nav-pills mb-4">
        <li class="nav-item"><a class="nav-link active" href="daftar.php">Daftar</a></li>
        <li class="nav-item"><a class="nav-link" href="daftar_ulang.php">Daftar Ulang</a></li>
        <li class="nav-item"><a class="nav-link" href="pengurusan.php">Pengurusan</a></li>
    </ul>

    <!-- Kontainer untuk Notifikasi Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
    <?php
    if (isset($_SESSION['notification'])) {
        $notification = $_SESSION['notification'];
        $type = $notification['type'];
        $message = htmlspecialchars($notification['message']);
        $icon = ($type == 'success') ? 'check-circle-fill' : 'exclamation-triangle-fill';
        $header_class = ($type == 'success') ? 'text-bg-success' : 'text-bg-danger';

        echo "
        <div id='notificationToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
            <div class='toast-header {$header_class}'>
                <svg class='bi flex-shrink-0 me-2' width='18' height='18' role='img' aria-label='{$type}:'><use xlink:href='#{$icon}'/></svg>
                <strong class='me-auto'>Notifikasi</strong>
                <small>Baru saja</small>
                <button type='button' class='btn-close btn-close-white' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            <div class='toast-body'>
                {$message}
            </div>
        </div>";
        unset($_SESSION['notification']);
    }
    ?>
    </div>

    <div class="card mb-4">
        <div class="card-header">Input Pendaftaran</div>
        <div class="card-body">
            <form action="proses/simpan_daftar.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Daftar</label>
                    <input type="date" name="tgl_daftar" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Data Pendaftar</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. Daftar</th>
                        <th>Nama Pemohon</th>
                        <th>Tgl Daftar</th>
                        <th>Hari</th>
                        <th>Tanggal (Datang)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = $conn->query("SELECT * FROM pendaftar ORDER BY no_daftar ASC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['no_daftar']) . "</td>
                        <td>" . htmlspecialchars($row['nama_pemohon']) . "</td>
                        <td>" . htmlspecialchars($row['tgl_daftar']) . "</td>
                        <td>" . htmlspecialchars($row['hari']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal']) . "</td>
                        <td>
                            <a href='edit_daftar_form.php?id=" . htmlspecialchars($row['no_daftar']) . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='proses/hapus_daftar.php?id=" . htmlspecialchars($row['no_daftar']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus data ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi dan tampilkan Toast jika ada
    const toastEl = document.getElementById('notificationToast');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // Tambahkan event listener untuk toggle tema setelah DOM dimuat
    window.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            // Atur status awal toggle berdasarkan tema yang aktif
            themeToggle.checked = document.documentElement.getAttribute('data-bs-theme') === 'dark';

            themeToggle.addEventListener('change', () => {
                const newTheme = themeToggle.checked ? 'dark' : 'light';
                localStorage.setItem('theme', newTheme);
                document.documentElement.setAttribute('data-bs-theme', newTheme);
            });
        }
    });
</script>
</body>
</html>
