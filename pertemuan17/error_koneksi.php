<?php
$conn = mysqli_connect("localhost","root","salahpassword","db_test");

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>