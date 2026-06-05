<?php

mysqli_report(MYSQLI_REPORT_OFF);

try {

    $conn = @mysqli_connect(
        "localhost",
        "root",
        "",
        "database_tidak_ada"
    );

    if (!$conn) {
        throw new Exception(mysqli_connect_error());
    }

    echo "Koneksi berhasil";

} catch (Exception $e) {

    echo "Terjadi Error Database: " . $e->getMessage();

} finally {

    echo "<br>Program selesai dijalankan.";

}

?>