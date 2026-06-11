<?php

$nama = $_FILES['berkas']['name'];

move_uploaded_file(
    $_FILES['berkas']['tmp_name'],
    "uploads/".$nama
);

header("Location: sukses.php");
exit();