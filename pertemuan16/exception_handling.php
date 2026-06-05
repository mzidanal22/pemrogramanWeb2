<?php

try {

    $angka1 = 10;
    $angka2 = 0;

    if ($angka2 == 0) {
        throw new Exception("Tidak bisa membagi dengan nol");
    }

    echo $angka1 / $angka2;

} catch (Exception $e) {

    echo "Error: " . $e->getMessage();

}
?>