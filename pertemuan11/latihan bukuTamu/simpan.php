<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukutamu");

$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

$query = "INSERT INTO buku_tamu(nama, email, pesan)
VALUES('$nama', '$email', '$pesan')";

mysqli_query($koneksi, $query);

echo "Data berhasil disimpan!";
?>