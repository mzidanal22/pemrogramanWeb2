<?php
$conn = mysqli_connect("localhost","root","","db_test");

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}

echo "Koneksi berhasil";
?>