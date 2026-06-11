<?php

$a = 10;

if($a > 0)
{
    $status = "Bilangan Positif";
}
else if($a < 0)
{
    $status = "Bilangan Negatif";
}
else
{
    $status = "Bilangan Nol";
}

?>

<h2>Hasil Pemeriksaan</h2>

<p><?= $status ?></p>

<a href="index.php">Kembali</a>