<?php

$value = "rahadian";
$value2 = "rahadi ramelan";

// Membuat cookie
setcookie("username", $value);
setcookie("namalengkap", $value2, time() + 3600); // Expire 1 jam

echo "<h1>Ini halaman pengesetan cookie</h1>";
echo "<h2>Klik <a href='cookies2.php'>di sini</a> untuk pemeriksaan cookies</h2>";

?>