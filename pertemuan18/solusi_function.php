<?php

include "function.php";

$hasil = jumlah(10,20);

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<div class="card">

<h1>✅ Solusi Undefined Function</h1>

<div class="code">
include "function.php";
</div>

<div class="success">
Hasil Penjumlahan = <?= $hasil ?>
</div>

<a href="index.php" class="btn">
Kembali Dashboard
</a>

</div>
</div>

</body>
</html>