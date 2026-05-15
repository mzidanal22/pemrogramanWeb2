<?php

$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "
    UPDATE tbl_mhs
    SET Age = '38'
    WHERE FirstName = 'Kirana'
    AND LastName = 'Swindari'
";

if (mysqli_query($con, $query)) {
    echo "Data berhasil diubah";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>