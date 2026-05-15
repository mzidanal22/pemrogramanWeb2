<?php

$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

mysqli_select_db($con, "lat_dbase");

$query = "DELETE FROM tbl_mhs WHERE LastName='Prabowo'";

if (mysqli_query($con, $query)) {

    if (mysqli_affected_rows($con) > 0) {
        echo "Data berhasil dihapus";
    } else {
        echo "Data tidak ditemukan";
    }

} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>