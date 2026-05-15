<?php

$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($con, "
    UPDATE tbl_mhs 
    SET Age = '36'
    WHERE FirstName = 'Karina' 
    AND LastName = 'Swandi'
");

mysqli_close($con);

?>