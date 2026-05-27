<?php

// Menghapus cookie dengan mengatur waktu kadaluarsa ke masa lalu
setcookie("username", "", time() - 3600);
setcookie("namalengkap", "", time() - 3600);

echo "<h1>Cookie berhasil dihapus.</h1>";
echo "<h2>Klik <a href='cookies1.php'>di sini</a> untuk penciptaan cookies</h2>";
echo "<h2>Klik <a href='cookies2.php'>di sini</a> untuk pemeriksaan cookies</h2>";

?>