<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "dbpenjualanrumah"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// sengaja salah nama tabel
$sql = "SELECT * FROM mahasiswaa";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error Query: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['nama'] . "<br>";
}

?>